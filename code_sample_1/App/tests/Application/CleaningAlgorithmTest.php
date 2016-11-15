<?php

/**
 * Car Cleaning Algorithm Test Class
 */
class CleaningAlgorithmTest extends PHPUnit_Framework_TestCase
{
    protected $ca;

    protected function setUp()
    {
        $this->ca = new Application\CleaningAlgorithm;
    }

    /**
     * To test next clean with dirty pod
     *
     */
    public function testNextCleanWithDirtyPod()
    {
        $car = array(
            'id' => 7,
            'pod_id' => 11,
            'class_id' => 3,
            'last_clean' => 5
        );

        $pods = array(
            11 => true,
            12 => false
        );

        $classes = array(
            1 => 0.7,
            2 => 1.0,
            3 => 1.5
        );

        $settings = array(
            'dirty_pod' => 0.9,
            'min_freq' => 7,
            'std_freq' => 14,
            'max_freq' => 28
        );

        $days = $this->ca->calculateNextClean($car, $pods, $classes, $settings);

        /* @Then I should get 14 */
        $this->assertEquals(14, $days);
    }

    /**
     * To test next clean without dirty pod
     *
     */
    public function testNextCleanWithOutDirtyPod()
    {
        $car = array(
            'id' => 8,
            'pod_id' => 12,
            'class_id' => 1,
            'last_clean' => 7
        );

        $pods = array(
            11 => true,
            12 => false
        );

        $classes = array(
            1 => 0.7,
            2 => 1.0,
            3 => 1.5
        );

        $settings = array(
            'dirty_pod' => 0.9,
            'min_freq' => 7,
            'std_freq' => 14,
            'max_freq' => 28
        );

        $days = $this->ca->calculateNextClean($car, $pods, $classes, $settings);

        /* @Then I should get 3 */
        $this->assertEquals(3, $days);
    }

    /**
     * To test next clean with empty pod id
     *
     */
    public function testNextCleanWithEmptyPodId()
    {
        $car = array(
            'id' => 8,
            'pod_id' => null,
            'class_id' => 1,
            'last_clean' => 7
        );

        $pods = array(
            11 => true,
            12 => false
        );

        $classes = array(
            1 => 0.7,
            2 => 1.0,
            3 => 1.5
        );

        $settings = array(
            'dirty_pod' => 0.9,
            'min_freq' => 7,
            'std_freq' => 14,
            'max_freq' => 28
        );

        echo $days = $this->ca->calculateNextClean($car, $pods, $classes, $settings);

        /* @Then I should get 2 */
        $this->assertEquals(2, $days);
    }

    /**
     * To test next clean with empty class id
     *
     */
    public function testNextCleanWithEmptyClassId()
    {
        $car = array(
            'id' => 8,
            'pod_id' => 11,
            'class_id' => null,
            'last_clean' => 7
        );

        $pods = array(
            11 => true,
            12 => false
        );

        $classes = array(
            1 => 0.7,
            2 => 1.0,
            3 => 1.5
        );

        $settings = array(
            'dirty_pod' => 0.9,
            'min_freq' => 7,
            'std_freq' => 14,
            'max_freq' => 28
        );

        $days = $this->ca->calculateNextClean($car, $pods, $classes, $settings);

        /* @Then I should get 6 */
        $this->assertEquals(6, $days);
    }
	
    /**
     * To test next clean for the case max value
     *
     */
    public function testNextCleanForMaxValue()
    {
        $car = array(
            'id' => 7,
            'pod_id' => 11,
            'class_id' => 3,
            'last_clean' => 5
        );

        $pods = array(
            11 => true,
            12 => false
        );

        $classes = array(
            1 => 0.7,
            2 => 1.0,
            3 => 1.5
        );

        $settings = array(
            'dirty_pod' => 0.9,
            'min_freq' => 7,
            'std_freq' => 14,
            'max_freq' => 18
        );

        $days = $this->ca->calculateNextClean($car, $pods, $classes, $settings);

        /* @Then I should get 13 */
        $this->assertEquals(13, $days);
    }

    /**
     * To test next clean for the case min value
     *
     */
    public function testNextCleanForMinValue()
    {
        $car = array(
            'id' => 7,
            'pod_id' => 12,
            'class_id' => 1,
            'last_clean' => 3
        );

        $pods = array(
            11 => true,
            12 => false
        );

        $classes = array(
            1 => 0.7,
            2 => 1.0,
            3 => 1.5
        );

        $settings = array(
            'dirty_pod' => 0.9,
            'min_freq' => 13,
            'std_freq' => 14,
            'max_freq' => 28
        );

        $days = $this->ca->calculateNextClean($car, $pods, $classes, $settings);

        /* @Then I should get 10 */
        $this->assertEquals(10, $days);
    }	
}

?>