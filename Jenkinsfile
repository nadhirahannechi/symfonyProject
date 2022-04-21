#!groovy

FOLDER_NAME = env.JOB_NAME.split('/')[0]

pipeline {
    agent {
        docker {
                    image 'runroom/php8.1-cli'
                    args '-v $HOME/composer:/home/jenkins/.composer:z'
                    reuseNode true
                }
    }
    environment {
        APP_ENV = 'test'

    }

    options {
        buildDiscarder(logRotator(numToKeepStr: '5'))
        disableConcurrentBuilds()
    }

    stages {
        stage('Install packages') {
            steps {
                // Install
                sh 'composer install --no-progress --no-interaction'
            }
          }
         stage('Unit Test') {
            steps {
                xunit([PHPUnit(
                    deleteOutputFiles: false,
                    failIfNotNew: false,
                    pattern: 'coverage/unitreport.xml',
                    skipNoTestFiles: true,
                    stopProcessingIfError: false
                )])
            }
          }
         stage('Report') {
            steps {
                 publishHTML(target: [
                    allowMissing: false,
                    alwaysLinkToLastBuild: false,
                    keepAll: true,
                    reportDir: 'coverage',
                    reportFiles: 'index.html',
                    reportName: 'Coverage Report'
                ])
            }
          }
         stage('Build'){
          steps{
           sh 'tar -cvzf dist.tar.gz --strip-components=1 coverage' 
           archive 'coverage.tar.gz'                     } 
                }
    
       

   stage('Nexus Upload Stage') {
     agent none 
     steps { 
        sh 'ls'
        withCredentials([[$class: 'UsernamePasswordMultiBinding', credentialsId: 'nexus_manvenuser',usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD']]) {
               sh 'curl -v -u ${USERNAME}:${PASSWORD} --upload-file coverage.tar.gz http://artefact.focus.com.tn:8081/repository/symfonyArtifacts/coverage.tar.gz' 
           } 
       } 
   } 
        stage('Deploy Stage') {
      steps { 
              sh 'ls -a'
          sh 'rm -R vendor'
          sh 'rm -R .docker'
                    sh 'rm -R .git'
                    sh 'rm -R .github'
                    sh 'rm -R tests'
      timeout(time: 200, unit: 'SECONDS') {
              pushToCloudFoundry(
                  target: 'https://api.cf.us10.hana.ondemand.com/',
                  organization: '2b1f4fe8trial',
                  cloudSpace: 'dev',
                  credentialsId: 'nadhira',
                )
          }
         
      }
    }
           


       
    }
}
