<?php
namespace Inani\Larapoll\Traits;

use Illuminate\Support\Facades\Session;
use Inani\Larapoll\Poll;

trait PollWriterVoting
{
    /**
     * Drawing the poll for checkbox case
     *
     * @param Poll $poll
     */
    public function drawCheckbox(Poll $poll,$inscritId,$lang)
    {
        //$options = $poll->options->pluck('name', 'id');

        $myoptions = $poll->options()->get() ;
        foreach($myoptions as $option){
            $option->name=  $option->getTranslation('name', $lang) ;
        }
        $options = $myoptions->pluck('name', 'id');

        echo view(config('larapoll_config.checkbox') ? config('larapoll_config.checkbox') :  'larapoll::stubs.checkbox', [
            'inscritId'=>$inscritId,
            'id' => $poll->id,
            /* 'question' => $poll->question, */
            'question' => $poll->getTranslation('question', $lang), 
            'options' => $options
        ]);
    }

    /**
     * Drawing the poll for the radio case
     *
     * @param Poll $poll
     */
    public function drawRadio(Poll $poll,$inscritId,$lang)
    {
      //  $options = $poll->options->pluck('name', 'id');           

        $myoptions = $poll->options()->get() ;
        foreach($myoptions as $option){
            $option->name=  $option->getTranslation('name', $lang) ;
        }
        $options = $myoptions->pluck('name', 'id');

        echo view(config('larapoll_config.radio') ? config('larapoll_config.radio') :'larapoll::stubs.radio', [
            'inscritId'=>$inscritId,
            'id' => $poll->id,
            /* 'question' => $poll->question, */
            'question' => $poll->getTranslation('question', $lang),
            'options' => $options
        ]);
    }
}
