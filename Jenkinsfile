pipeline {
	agent {
		docker {
			image 'composer:latest'
		}
	}
	stages {
		stage('Build') {
			steps {
				sh 'composer install'
			}
		}
		stage('Test') {
			steps {
                sh './vendor/bin/phpunit tests --log-junit logs/unitreport.xml -c tests/phpunit.xml tests'
            }
		}
	}
	post {
		always {
			junit testResults: 'logs/unitreport.xml'
			recordIssues( 
				enabledForFailure: true,
    			tool: php()
			)
			recordIssues(
				enabledForFailure: true,
				tool: phpCodeSniffer(pattern: 'style.xml')
			)
		}
	}
}