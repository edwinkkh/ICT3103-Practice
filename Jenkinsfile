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

		stage("Run dependency check") {
			agent {
				docker {
					image 'maven'
				}
			}
			steps {
				dependencyCheck additionalArguments: '--format HTML --format XML', odcInstallation: 'Default'
			}
			post {
				dependencyCheckPublisher pattern: 'dependency-check-report.xml'
			}
		}
		// stage('Run sonar qube'){
		// 	agent {
		// 		docker {
		// 			image 'maven'
		// 		}
		// 	}
		// 	steps {
		// 		script {
		// 			def scannerHome = tool 'SonarQube';
		// 			withSonarQubeEnv(){
		// 				sh "${tool("SonarQube")}/bin/sonar-scanner \
		// 	 			-Dsonar.projectKey=TestProject \
		// 				-Dsonar.sources=. \
		// 				-Dsonar.analysis.mode= \
		// 				-Dsonar.host.url=http://192.168.1.163:9000 \
		// 				-Dsonar.login=000e707a99f6a85bc193a69890f1755df79a729b"
		// 			}
		// 		}
		// 	}
		// 	post {
		// 		always {
		// 			recordIssues(
		// 				enabledForFailure: true, 
		// 				tool: sonarQube()
		// 			)
		// 		}
		// 	}
		// }
	}
}