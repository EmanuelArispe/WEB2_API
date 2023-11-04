
<?php
class VerifyHelpers{

    public static function verifyData($data)
    {
        foreach ($data as $elem) {
            if (!(isset($elem)) || (empty($elem))) {
                return false;
            }
        }
        return true;
    }

}