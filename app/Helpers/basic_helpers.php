<?php

use Carbon\Carbon;

if (!function_exists('pr')) {
    function pr($arr, $isDie = false)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
        if ($isDie == true) {
            die;
        }
    }
}

if (!function_exists('assets_url')) {

    function assets_url($folder, $path)
    {
        $url = asset('public/assets/' . $folder . '/' . $path);

        return $url;
    }
}

if (!function_exists('convertToAppTimezone')) {
    /**
     * Convert UTC time to application timezone
     *
     * @param mixed $utcTime
     * @param string $format
     * @return string|null
     */
    function convertToAppTimezone($utcTime, $format = 'Y-m-d H:i:s')
    {
        if (empty($utcTime)) {
            return null;
        }

        try {
            // Check if $utcTime is a numeric value (timestamp)
            if (is_numeric($utcTime)) {
                if (strlen($utcTime) > 10) {
                    // Convert milliseconds to seconds
                    $utcTime = $utcTime / 1000;
                }
                // Create Carbon instance from timestamp
                $parsedDate = Carbon::createFromTimestamp($utcTime);
            } else {
                // If $utcTime is not numeric, assume it's a date string
                $parsedDate = Carbon::parse($utcTime, 'UTC'); // Assume input is UTC if string
            }

            // Convert to application timezone and format
            $newDate = $parsedDate->setTimezone(config('app.timezone'))->format($format);
            $newDate = date($format, strtotime($newDate));
            return $newDate;
        } catch (\Exception $e) {
            // Log the error or return null for invalid inputs
            \Log::error("convertToAppTimezone error: {$e->getMessage()}");
            return null;
        }
    }
}

if (!function_exists('created_at')) {
    function created_at()
    {
        return date('Y-m-d H:i:s');
    }
}