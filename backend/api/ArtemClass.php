<?php
    namespase API{
        class ART{
            public function func()
            {
                $b = \Utils::Request('b');
                $a = \Utils::Request('a');
                return ($a + $b);
            }
        }
};