node { 
    stage("Dev_get_code"){
        git url: 'https://github.com/hkbrain/projectDemo.git', branch: 'dev'
    }
    
    stage("Dev_composer_install") {
        // Run `composer update` as a shell script
        sh 'composer update'
    }
    stage("Dev_unit_tests") {
        // Run PHPUnit
        sh 'vendor/bin/phpunit --testsuite Unit --coverage-html unit-tests/'
        publishHTML([allowMissing: false, alwaysLinkToLastBuild: false, keepAll: false, reportDir: 'unit-tests', reportFiles: 'index.html', reportName: 'Unit Tests Report', reportTitles: ''])
    }
   
    
    
}

