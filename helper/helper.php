<?php

    require_once "../config/db.php";

    class Helper {
        public static function maskNumber($number) {
            $length = strlen($number);
            if ($length <= 6) {
                return str_repeat('*', $length); // Mask all if 4 or fewer digits
            } else {
                $visiblePart = substr($number, -3); // Get the last 4 digits
                $maskedPartLength = $length - 3; // Calculate how many to mask
                $maskedPart = str_repeat('*', $maskedPartLength); // Create asterisks
                return $maskedPart . $visiblePart; // Combine masked and visible parts
            }
        }

        public static function maskString($string) {
            $visible = 6; // number of visible characters at the end
            $length = strlen($string);

            // if string is shorter than or equal to 6, no need to mask
            if ($length <= $visible) {
                return $string;
            }

            // mask everything except last 6
            $maskedPart = str_repeat('*', $length - $visible);
            $visiblePart = substr($string, -$visible);

            return $maskedPart . $visiblePart;
        }
    }

    $helper = new Helper();