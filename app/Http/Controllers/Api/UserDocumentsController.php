<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserDocumentAnnotationRequest;
use App\Http\Requests\UploadDocumentRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Models\UserDocument;
use App\Models\UserDocumentAnnotation;
use App\Models\UserDocumentFiles;
use Illuminate\Support\Facades\Storage;
use Exception;

class UserDocumentsController extends ApiBaseController
{
	public function saveDocumentAnnotationData(UserDocumentAnnotationRequest $request){	
		 try{
			if (isset($request->validator) && $request->validator->fails()) {
				$response_message=$request->validator->errors()->first();
            	return  $this->sendError($response_message,$request->validator->messages(),422);
    		}
            $annotationData=$request->input('annotationData'); 
            $documentId=$request->input('documentId');
            $userDocument=UserDocument::find($documentId);
            $userDocumentAnnotation=UserDocumentAnnotation::find($documentId);
            if(empty($userDocumentAnnotation)){
                $userDocumentAnnotation=new UserDocumentAnnotation();
                $userDocumentAnnotation->user_id=$userDocument->user_id;
                $userDocumentAnnotation->document_id=$documentId;
            }
            $userDocumentAnnotation->annotation_data=$annotationData;
            $userDocumentAnnotation->save();
            return  $this->sendSuccess([], 'data process successfully');
        }
        catch (Exception $e){
            $response_message=$e->getMessage();
            return  $this->sendError($response_message,[],422);
        }

		return $response;
	}

    public function getDocumentAnnotationData($id){
        $userDocument=UserDocument::find($id);
        if(!empty($userDocument)){
            $userDocumentAnnotation=UserDocumentAnnotation::find($id);
            $data['documentId']=$id;
            $data['documentName']=$userDocument->name;
            $data['documentUrl']=$userDocument->getFileUrl();
            $data['annotationData']=empty($userDocumentAnnotation)?'':
            $userDocumentAnnotation->annotation_data;
            return  $this->sendSuccess($data, '');
        }
        $response_message='Document Not Found';
        return  $this->sendError($response_message,[],404);
    }

    public function uploadDocumentFile(UploadDocumentRequest $request){
         try{
            if (isset($request->validator) && $request->validator->fails()) {
                $response_message=$request->validator->errors()->first();
                return  $this->sendError($response_message,$request->validator->messages(),422);
            }

            $documentId=$request->input('documentId');
            $userDocument=UserDocument::find($documentId);
            $upload_response = uploadFile($request, 'document_file');

            if (!empty($upload_response['success'])) {
                $file = $upload_response['data'];
                $userDocumentFile=new UserDocumentFiles();
                $userDocumentFile->user_id=$userDocument->user_id;
                $userDocumentFile->document_id=$documentId;
                $userDocumentFile->file=$file;
                $userDocumentFile->save();
                $data['fileUrl']=$userDocumentFile->getFileUrl();
                $data['documentId']=$documentId;
                return  $this->sendSuccess($data, 'data process successfully');

            } else {
                $response_type = 'error';
                $response_message = 'Unable to upload file, Please try again.';
                return  $this->sendError($response_message,[],400);
            }
        }
        catch (Exception $e){
            $response_message=$e->getMessage();
            return  $this->sendError($response_message,[],422);
        }

        return $response;


    }

}

?>