pipeline {
	agent {
		dockerfile true
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
				sh './vendor/bin/phpcs --report=checkstyle --report-file=checkstyle.xml . --ignore=vendor'
			}
		}
		stage('Run sonar qube'){
			steps {
				script {
					def scannerHome = tool 'SonarQube';
					withSonarQubeEnv(){
						sh "${tool("SonarQube")}/bin/sonar-scanner \
					 	-Dsonar.projectKey=TestProject \
						-Dsonar.sources=. \
						-Dsonar.host.url=http://192.168.174.130:9000 \
						-Dsonar.login=0342f21433d2045fb86fd6b6d5bbb31a98e83af6"
					}
				}
			}
		}
	}
	
}