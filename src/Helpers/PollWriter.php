<?php

namespace Inani\Larapoll\Helpers;

use Illuminate\Support\Facades\Auth;
use Inani\Larapoll\Guest;
use Inani\Larapoll\Poll;
use Inani\Larapoll\Traits\PollWriterResults;
use Inani\Larapoll\Traits\PollWriterVoting;
use Modules\Inscrit\Entities\Inscrit;

class PollWriter
{
    use PollWriterResults,
        PollWriterVoting;

    /**
     * Draw a Poll
     *
     * @param Poll $poll
     * @return string
     */
    public function draw($poll,$inscritId,$lang)
    {
       
    //this bellow line for test i should remove it when workin with authentification    return $this->drawRadio($poll);
    //return $this->drawRadio($poll,$lang);
        
        if(is_int($poll)){
            $poll = Poll::findOrFail($poll);
        }

        if(!$poll instanceof Poll){
            throw new \InvalidArgumentException("The argument must be an integer or an instance of Poll");
        }

        if ($poll->isLocked()) {
            return 'Ce sondage est fermmé';
       }

      //  $voter =  auth(config('larapoll_config.admin_guard'))->user();   
      $voter =null;
        if ($inscritId) {
         $voter = Inscrit::find($inscritId);
          }

        if (!is_null($voter)) {
           
                if ($voter->hasVoted($poll->id)) {
                if(session()->has('success')){
                    if ($poll->showResultsEnabled()) {
                            return $this->drawResult($poll);
                        } 
                        else return 'Merci ';
                    
                }
                return 'Vous avez déja voté ';
                }  

               if ($poll->isRadio()) { 
                     return $this->drawRadio($poll,$inscritId,$lang);
               }
            
               return $this->drawCheckbox($poll,$inscritId,$lang);  

       }                                                    
       
   return 'not allowed for visitors'  ;

     
    }
}
