<?php
    namespace API{
        class br{
            public function aa()
            {
                $b = $_REQUEST['b'];
                $a = $_REQUEST['a'];
                return ($a + $b);
            }
        }
}