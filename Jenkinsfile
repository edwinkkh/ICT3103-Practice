pipeline {
	agent none
	stages {
		// stage('Test application') {
		// 	agent {
		// 		docker {
		// 			image 'composer:latest'
		// 		}
		// 	}

		// 	steps {
		// 		sh 'composer install'
		// 		sh './vendor/bin/phpunit tests --log-junit logs/unitreport.xml -c tests/phpunit.xml tests'
		// 		sh './vendor/bin/phpcs --report=checkstyle --report-file=checkstyle.xml . --ignore=vendor'
		// 	}

		// 	post {
		// 		always {
		// 			junit testResults: 'logs/unitreport.xml'
		// 			recordIssues( 
		// 				enabledForFailure: true,
		// 				tool: php()
		// 			)
		// 			recordIssues(
		// 				enabledForFailure: true,
		// 				tool: phpCodeSniffer(pattern: 'checkstyle.xml')
		// 			)
		// 		}	
		// 	}
		// }

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
						-Dsonar.report.export.path=.scannerwork/sonar-report.json \
						-Dsonar.host.url=http://192.168.1.173:9000 \
						-Dsonar.login=05d5a294057ad394670a801269e469d7540dcfce"
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