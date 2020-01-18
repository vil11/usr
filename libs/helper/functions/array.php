<?php

/**
 * Get not unique values from array.
 * Function works with array elements of the highest level only.
 * Function returns empty array if all array elements are unique.
 *
 * @param array $array
 * @return array
 */
function getNotUniqueArrayValues(array $array)
{
    return array_unique(array_diff_assoc($array, array_unique($array)));
}

/**
 * Get not unique values from array.
 * Function works with array elements of the highest level only.
 * Function returns empty array if all array elements are unique.
 *
 * @param array $array
 * @return array
 */
function getNotUniqueArrayValues2(array $array)
{
    $notUniqueValues = array();
    for ($i = 0; $i < count($array); $i++) {
        $a = $array[$i];
        for ($j = 0; $j < count($array); $j++) {
            $b = $array[$j];
            if ($a == $b && $i != $j && !in_array($a, $notUniqueValues)) {
                $notUniqueValues[] = $a;
            }
        }
    }

    return $notUniqueValues;
}

/**
 * Get not unique values from array.
 * Function works with array elements of the highest level only.
 * Function returns empty array if all array elements are unique.
 *
 * @param array $array
 * @return array
 */
function getNotUniqueArrayValues3(array $array)
{
    $notUniqueValues = array();
    foreach ($array as $key => $value) {
        $arrayCopy = $array;
        unset($arrayCopy[$key]);
        if (in_array($value, $arrayCopy)) {
            $notUniqueValues[] = $value;
        }
    }

    return array_unique($notUniqueValues);
}

/**
 * Convert array into format of phpunit data provider.
 *
 * @param array $array
 * @return array
 */
function prepareDataProvider(array $array)
{
    $dataProvider = array();
    foreach ($array as $value) {
        $dataProvider[] = array($value);
    }

    return $dataProvider;
}
