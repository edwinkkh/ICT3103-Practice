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
		stage('Check style'){
			steps {
				sh './vendor/bin/phpcs --report=xml --report-file=checkstyle.xml . --ignore=vendor'
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
				tool: phpCodeSniffer(pattern: 'checkstyle.xml')
			)
		}
	}
}