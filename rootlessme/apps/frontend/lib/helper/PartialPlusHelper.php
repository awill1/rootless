<?php

/**
 * Begins the capturing of a slot,
 * but echoes the current value of a slot with the same name,
 * if one exists, before capturing the rest of the slot content.
 *
 * <strong>Example</strong>
 * <code>
 *  // first myslot
 *  slot('myslot');
 *  echo 'something to put in "myslot"';
 *  end_slot();
 *  // second myslot
 *  append_to_slot('myslot');
 *  echo 'some stuff to append to existing "myslot" slot';
 *  end_slot();
 * </code>
 *
 * @param   string slot name
 * @return  void
 * @see     end_append_to_slot, slot, end_slot
 */
function append_to_slot($name)
{
    // check for the existence of a slot with the same name
    $content = '';
    if (has_slot($name)) $content = get_slot($name);

    // regardless, begin capturing the slot
    slot($name);

    // echo either a blank string, or the previous value of the slot with the same name
    echo $content;
}

/**
 * Stops the content capture and save the content in the slot.
 * This function is interchangeable with end_slot, and is not necessary.
 * It is useful only for consistency's sake.
 *
 * @return  void
 * @see     append_to_slot, slot, end_slot
 */
function end_append_to_slot()
{
    // simply end the current slot
    end_slot();
}

/**
 * Begins the capturing of a slot,
 * but saves the current value of a slot with the same name,
 * if one exists, and then proceeds to capture the slot content.
 *
 * @param   string slot name
 * @return  void
 * @see     end_prepend_to_slot, slot, end_slot
 */
function prepend_to_slot($name)
{
    $context = sfContext::getInstance();
    $response = $context->getResponse();

    // check for the existence of a slot with the same name
    $content = '';
    if (has_slot($name)) $content = get_slot($name);

    // save the current slot value in a temporary location
    $response->setParameter('old_slot', $content, 'symfony/view/sfView/slot');

    // begin capturing the slot
    slot($name);
}

/**
 * Retrieves the old value of a slot which was backed up in prepend_to_slot,
 * if one exists, and echoes this value,
 * and then proceeds to stop the content capture and save the content in the slot.
 *
 * @return  void
 * @see     prepend_to_slot, slot, end_slot
 */
function end_prepend_to_slot()
{
    $context = sfContext::getInstance();
    $response = $context->getResponse();

    // retrieve the old value for this slot
    $content = $response->getParameter('old_slot', '', 'symfony/view/sfView/slot');
    // remove the old value
    $response->getParameterHolder()->remove('old_slot', 'symfony/view/sfView/slot');

    // echo the old value of the slot, or a blank string if no slot existed
    echo $content;

    // end the current slot
    end_slot();
}