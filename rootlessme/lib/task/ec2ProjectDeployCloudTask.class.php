<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Deploys a project to an amazon cloud instance
 *
 * @package    symfony
 * @subpackage task
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Ryan Weaver <ryan.weaver@iostudio.com>
 * @version    SVN: $Id$ $Author$
 */
class ec2ProjectDeployCloudTask extends sfBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('server', sfCommandArgument::REQUIRED, 'The server name'),
    ));

    $this->addOptions(array(
      new sfCommandOption('go', null, sfCommandOption::PARAMETER_NONE, 'Do the deployment'),
      new sfCommandOption('rsync-dir', null, sfCommandOption::PARAMETER_REQUIRED, 'The directory where to look for rsync*.txt files', 'config'),
      new sfCommandOption('rsync-options', null, sfCommandOption::PARAMETER_OPTIONAL, 'To options to pass to the rsync executable', '-azCP --force --delete'),
    ));
    
    $this->aliases = array('ec2-sync');
    $this->namespace = 'ec2';
    $this->name = 'deploy';
    $this->briefDescription = 'Deploys a project to an ec2 cloud instance';

    $this->detailedDescription = <<<EOF
The [ec2:deploy|INFO] task deploys a project on a ec2 cloud instance:

  [./symfony ec2:deploy production|INFO]

The server must be configured in [config/properties.ini|COMMENT]:

  [[production]
    host=www.example.com
    port=22
    user=fabien
    dir=/var/www/sfblog/
    keypair=/path/to/ec2-keypair.pem
    type=rsync|INFO]

The keypair property can also optionally be relative to the project root
by omitting the beginning slash:

    keypair=config/ec2-keypair.pem

To automate the deployment, the task uses rsync over SSH.
You must configure SSH access with a key or configure the password
in [config/properties.ini|COMMENT].

By default, the task is in dry-mode. To do a real deployment, you
must pass the [--go|COMMENT] option:

  [./symfony project:deploy --go production|INFO]

Files and directories configured in [config/rsync_exclude.txt|COMMENT] are
not deployed:

  [.svn
  /web/uploads/*
  /cache/*
  /log/*|INFO]

You can also create a [rsync.txt|COMMENT] and [rsync_include.txt|COMMENT] files.

If you need to customize the [rsync*.txt|COMMENT] files based on the server,
you can pass a [rsync-dir|COMMENT] option:

  [./symfony project:deploy --go --rsync-dir=config/production production|INFO]

Last, you can specify the options passed to the rsync executable, using the 
[rsync-options|INFO] option (defaults are [-azC|INFO]):

  [./symfony project:deploy --go --rsync-options=avz|INFO]
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $env = $arguments['server'];

    $ini = sfConfig::get('sf_config_dir').'/properties.ini';
    if (!file_exists($ini))
    {
      throw new sfCommandException('You must create a config/properties.ini file');
    }

    $properties = parse_ini_file($ini, true);

    if (!isset($properties[$env]))
    {
      throw new sfCommandException(sprintf('You must define the configuration for server "%s" in config/properties.ini', $env));
    }

    $properties = $properties[$env];

    if (!isset($properties['host']))
    {
      throw new sfCommandException('You must define a "host" entry.');
    }

    if (!isset($properties['dir']))
    {
      throw new sfCommandException('You must define a "dir" entry.');
    }

    $host = $properties['host'];
    $dir  = $properties['dir'];
    $keypair  = $properties['keypair'];
    $user = isset($properties['user']) ? $properties['user'].'@' : '';

    if (substr($dir, -1) != '/')
    {
      $dir .= '/';
    }
    
    $ssh = 'ssh';
    
    if (strpos($keypair, '/') === 0)
    {
      $ssh .= ' -i ' . $keypair;
    }
    else
    {
      $ssh .= ' -i ' . sfConfig::get('sf_root_dir') . '/' . $keypair;
    }
    
    if (isset($properties['port']))
    {
      $port = $properties['port'];
      $ssh .= ' -p'.$port;
    }
    
    $ssh = sprintf('"%s"', $ssh);

    if (isset($properties['parameters']))
    {
      $parameters = $properties['parameters'];
    }
    else
    {
      $parameters = $options['rsync-options'];
      if (file_exists($options['rsync-dir'].'/rsync_exclude.txt'))
      {
        $parameters .= sprintf(' --exclude-from=%s/rsync_exclude.txt', $options['rsync-dir']);
      }

      if (file_exists($options['rsync-dir'].'/rsync_include.txt'))
      {
        $parameters .= sprintf(' --include-from=%s/rsync_include.txt', $options['rsync-dir']);
      }

      if (file_exists($options['rsync-dir'].'/rsync.txt'))
      {
        $parameters .= sprintf(' --files-from=%s/rsync.txt', $options['rsync-dir']);
      }
    }

    $dryRun = $options['go'] ? '' : '--dry-run';
    //$this->log($this->getFilesystem()->sh("rsync --progress $dryRun $parameters --rsh $ssh ./ $user$host:$dir"));
    $this->log($this->getFilesystem()->execute("rsync --progress $dryRun $parameters --rsh $ssh ./ $user$host:$dir"));
  }
}
