<?php
    namespase API{
        class ART{
            public function __construct()
            {
                $b = \Utils::Request('b');
                $a = \Utils::Request('a');
                return ($a + $b);
            }
        }
};