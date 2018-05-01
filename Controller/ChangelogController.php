<?php
/**
 * Kenshimdev : Développeur web et administrateur système (https://kenshimdev.fr/)
 * @author        Kenshimdev - https://kenshimdev.fr
 * @copyright     Kenshimdev - All rights reserved
 * @link          http://mineweb.org/market
 * @since         10.03.17
 */

class ChangelogController extends AppController{

    /**
     * Called when the route /changelog is called.
     */
    public function index(){
        //Load configuration
        $this->loadModel('Changelog.Changelogs');
        //Retrieves the last 35 logs
        $changelogs = $this->Changelogs->find('all', ['order' => ['created desc'], 'limit' => 35]);

        return $this->set(compact('changelogs'));
    }

    /**
     * Called when the route /admin/xenbridge is called.
     */
    public function admin_index(){
        if($this->isConnected && $this->User->isAdmin()){
            $this->layout = 'admin';

            //Get list of logs
            $this->loadModel('Changelog.Changelogs');
            $changelogs = $this->Changelogs->find('all', ['order' => ['id desc']]);

            if ($this->request->is('post')) {
                $changelog_level = $this->request->data["level"];
                $changelog_author = $this->request->data["author"];
                $changelog_comment = $this->request->data["description"];

                //Form validation
                if(!isset($changelog_level) || ($changelog_level < 0 || $changelog_level > 4)){
                    $this->Session->setFlash($this->Lang->get('CL_LEVEL_ERROR'), 'default.error');
                    return $this->redirect($this->referer());
                }

                if(!isset($changelog_author) || empty($changelog_author) || strlen($changelog_author) < 2 || strlen($changelog_author) > 50){
                    $this->Session->setFlash($this->Lang->get('CL_AUTHOR_ERROR'), 'default.error');
                    return $this->redirect($this->referer());
                }

                if(!isset($changelog_comment) || empty($changelog_comment) || strlen($changelog_comment) < 10){
                    $this->Session->setFlash($this->Lang->get('CL_COMMENT_ERROR'), 'default.error');
                    return $this->redirect($this->referer());
                }

                //Add a new log
                $this->Changelogs->create();
                if(
                    $this->Changelogs->save(
                        ['level' => $changelog_level, 
                        'author' => $changelog_author, 
                        'description' => $changelog_comment, 
                        'created' => date('Y-m-d H:i:s')
                   ])
                ){
                    $this->Session->setFlash($this->Lang->get('CL_ADD_SUCCESS'), 'default.success');
                    return $this->redirect($this->referer());
                }
              
                //error occurred
                $this->Session->setFlash($this->Lang->get('CL_ERROR_OCCURED'), 'default.error');
                return $this->redirect($this->referer());
            }

            return $this->set(compact('changelogs'));
        }else{
            return $this->redirect('/');
        }
    }

    /**
     * Deletes a log according to the id passed in parameter
     * @param $id - id of the log to delete
     */
    public function admin_delete($id = null){
        if($this->isConnected && $this->User->isAdmin()){
            
            if ($this->request->is('post')){
                throw new MethodNotAllowedException();
            }

            $this->loadModel('Changelog.Changelogs');
            if ($this->Changelogs->delete($id)){
                $this->Session->setFlash($this->Lang->get('CL_ADMIN_DELETE'), 'default.success');
            }

            return $this->redirect($this->referer());

        }else{
            return $this->redirect('/');
        }
    }

}
