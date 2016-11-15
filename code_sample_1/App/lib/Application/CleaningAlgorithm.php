<?php
namespace Application;

/**
 * Car Cleaning Algorithm Class
 */
class CleaningAlgorithm
{
    /** Default Pod ID **/
    const DEFAULT_POD_ID = 11;

    /** Default Class ID **/
    const DEFAULT_CLASS_ID = 2;

    /**
     * To calculate the number of day(s) until next clean is due
     *
     * @param mixed $car Array structure
     *
     * @param mixed $pods Array structure
     *
     * @param mixed $classes Array structure
     *
     * @param mixed $settings Array structure
     *
     * @return integer Indicates the number of days. If it is over due return zero.
     */
    public static function calculateNextClean($car, $pods, $classes, $settings)
    {
        $car_class = 1;
        $car_dirty_pod = 1;
        $car_std_freq = $settings['std_freq'];
        $last_clean = $car['last_clean'];

        $pod_id = empty($car['pod_id']) ? CleaningAlgorithm::DEFAULT_POD_ID : intval($car['pod_id']);

        $class_id = empty($car['class_id']) ? CleaningAlgorithm::DEFAULT_CLASS_ID : intval($car['class_id']);

        if (isset($pods[$pod_id]) && (bool)$pods[$pod_id] == true) {
            $car_dirty_pod = $settings['dirty_pod'];
        }

        if (isset($classes[$class_id])) {
            $car_class = $classes[$class_id];
        }

        $freq = $car_std_freq * $car_dirty_pod * $car_class;

        /* if calculated frequency less than the minimum value */
        if ($settings['min_freq'] > $freq) {
			$freq = $settings['min_freq'];
		}
		
		/* if calculated frequency greater than the maximum value */
		if($settings['max_freq'] < $freq) {
            $freq = $settings['max_freq'];
        }

        /* Round the nearest whole number of days */
        $freq = round($freq);

        /* Checking for negative value */
        if ($freq >= $last_clean) {
            return intval($freq - $last_clean);
        } else {
            return 0;
        }
    }
}