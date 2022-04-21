@Library('piper-lib-os') _

node() {
   
    stage('Init') {
       cleanWs()
       checkout scm
       setupCommonPipelineEnvironment script:this
       
    }
    stage('Build Stage') {
       mavenExecute(
         script: this,
         goals: ['install']
      )
    }
 
    stage('Unit Tests Stage') {
       mavenExecute(
           script: this,
           goals: ['test']
           )
       testsPublishResults(
           script: this,
           jacoco: true
       )
    }
   
    stage('Nexus Upload Stage') {
        nexusUpload (
         script: this,
         url: 'artefact.focus.com.tn:8081',
         mavenRepository:'maven-snapshots',
         nexusCredentialsId:'nexus_manvenuser',
         format:'maven',
         globalSettingsFile:'.pipeline/global_settings.xml'
           )
    }
   
    stage('Deploy Stage') {
      cloudFoundryDeploy(
         script: this,
         cloudFoundry: [apiEndpoint: 'https://api.cf.us10.hana.ondemand.com/', appName: 'symfonyProject', manifest: './manifest.yml', org: '2b1f4fe8trial', space: 'dev', credentialsId: 'null']
        )
    }
   }
