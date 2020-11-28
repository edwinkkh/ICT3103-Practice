pipeline {
	agent none
	stages {
		stage('Test application') {
			agent {
				docker {
					image 'composer:latest'
				}
			}
			
			steps {
				sh 'composer install'
			}

			steps {
                sh './vendor/bin/phpunit tests --log-junit logs/unitreport.xml -c tests/phpunit.xml tests'
            }

			steps {
				sh './vendor/bin/phpcs --report=checkstyle --report-file=checkstyle.xml . --ignore=vendor'
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

		stage('Run sonar qube'){
			agent {
				docker {
					image 'maven'
				}
			}
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
			post {
				always {
					recordIssues(
						enabledForFailure: true, 
						tool: sonarQube()
					)
				}
			}
		}
	}
}