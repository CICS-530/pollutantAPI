<?php
/*
 * Custom test suite to execute all tests.
 *
 * Taken from 
 * http://stackoverflow.com/questions/11364237/cakephp-jenkins-phing-run-all-unit-tests
 */

class AllTestsTest extends PHPUnit_Framework_TestSuite {

    public static function suite() {

        $path = APP . 'Test' . DS . 'Case' . DS;

        $suite = new CakeTestSuite('All tests');
        $suite->addTestDirectory($path . 'Model' . DS);
        $suite->addTestDirectory($path . 'Controller'. DS);
        $suite->addTestDirectory($path . 'View'. DS);
        return $suite;

    }

}