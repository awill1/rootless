<?php

/**
 * ReviewsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ReviewsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ReviewsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Reviews');
    }

    public function getReviewsForPersonWithProfile($person_id)
    {
        // Need this function to match this query
        // select * from reviews
        // where reviewee_id = 1
        // order by created_at;

        $q = $this->createQuery('r')
                ->leftJoin('r.People p')
                ->leftJoin('p.Profiles pr')
                ->where('r.reviewee_id = ?', $person_id)
                ->orderBy('r.created_at DESC');

        return $q->execute();
    }
    
    public function getReviewsSummaryForPerson($person_id)
    {
        $connection = Doctrine_Manager::connection();
        $query = 'SELECT AVG(was_safe)*100 AS safety_average, 
                         AVG(was_friendly)*100 AS friendliness_average ,
                         AVG(was_punctual)*100 AS punctuality_average ,
                         AVG(was_courteous)*100 AS rider_average ,
                         COUNT(*) AS review_count
                  FROM reviews
                  WHERE reviewee_id = '.$person_id;
        $statement = $connection->execute($query);
        $statement->execute();
        $resultset = $statement->fetch(PDO::FETCH_OBJ);
        $safetyAverage = $resultset->safety_average;
        $friendlinessAverage = $resultset->friendliness_average;
        $punctualityAverage = $resultset->punctuality_average;
        $riderAverage = $resultset->rider_average;
        $reviewCount = $resultset->review_count;

        return array(
            'safetyAverage' => $safetyAverage,
            'friendlinessAverage' => $friendlinessAverage,
            'punctualityAverage' => $punctualityAverage,
            'riderAverage' => $riderAverage,
            'reviewCount' => $reviewCount
        );
    }
}