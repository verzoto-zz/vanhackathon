<?php

class ApiController extends Controller
{

	// Members
   /**
    * Key which has to be in HTTP USERNAME and PASSWORD headers
    */
    Const APPLICATION_ID = 'ASCCPE';

	/**
    * Default response format
    * either 'json' or 'xml'
	*/
    private $format = 'json';


	/**
    * @return array action filters
    */
	public function filters(){
        return array();
    }
	
	
    public function actionView(){

        if(!isset($_GET['id']))
            $this->_sendResponse(500, 'Error: Parameter <b>id</b> is missing' );
        
        switch($_GET['model']){
        	
            case 'video':
                $model = new VideoModel();
                $query = $model->GetActionsByVideo($_GET['id']);
                break;
            
            case 'choices':
                $model = new VideoModel();
                $query = $model->GetChoicesByAction($_GET['id']);
                break;

            default:
                $this->_sendResponse(501, sprintf('Mode <b>view</b> is not implemented for model <b>%s</b>', $_GET['model']) );
                Yii::app()->end();                
        }
        
        
        if (empty($query))
            $this->_sendResponse(404, 'No Item found with id '.$_GET['id']);
        else
            $this->_sendResponse(200, CJSON::encode($query));
            
    }
    
    
    public function actionUpdate()
    {
        $json = file_get_contents('php://input');
        $put_vars = CJSON::decode($json,true);
     
        switch($_GET['model'])
        {

            case 'choice':
                $model = new VideoModel();
                $query = $model->UpdateChoice($_GET['id']);
                break;
                
            default:
                $this->_sendResponse(501, 
                    sprintf( 'Error: Mode <b>update</b> is not implemented for model <b>%s</b>',
                    $_GET['model']) );
                Yii::app()->end();
        }
        
        if($_GET['model'] === null)
            $this->_sendResponse(400, 
                    sprintf("Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",
                    $_GET['model'], $_GET['id']) );
     
        if (empty($query))
            $this->_sendResponse(404, 'No Item found with id '.$_GET['id']);
        else
            $this->_sendResponse(200, CJSON::encode($query));    
    }    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html'){
        //set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        
        // pages with body are easy
        if($body != ''){
            //send the body
            echo $body;
            
        } else {
            // we need to create the body if none is passed
            // create some body messages
            $message = '';
 
            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch($status){
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }
 
            // servers don't always have a signature turned on 
            // (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
 
            // this should be templated in a real-world solution
            $body = '
            <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
            <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
            </head>
            <body>
                <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
                <p>' . $message . '</p>
                <hr />
                <address>' . $signature . '</address>
            </body>
            </html>';
 
            echo $body;
        }
        
        Yii::app()->end();       
    }


    private function _getStatusCodeMessage($status){
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }
        

}