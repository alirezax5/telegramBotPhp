<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Poll
 * @package telegramBotApiPhp\Types
 * @method string getId()
 * @method string getQuestion()
 * @method PollOption getOptions()
 * @method int getTotalVoterCount()
 * @method bool getIsClosed()
 * @method bool getIsAnonymous()
 * @method string getType()
 * @method bool getAllowsMultipleAnswers()
 * @method int getCorrectOptionId()
 * @method string getExplanation()
 * @method ArrayOfMessageEntity getExplanationEntities()
 * @method int getOpenPeriod()
 * @method int getCloseDate()
 */
class Poll extends base
{
    protected static $map = [
        'id' => true,
        'question' => true,
        'options' => ArrayOfPollOption::class,
        'total_voter_count' => true,
        'is_closed' => true,
        'is_anonymous' => true,
        'type' => true,
        'allows_multiple_answers' => true,
        'correct_option_id' => true,
        'explanation' => true,
        'explanation_entities' => ArrayOfMessageEntity::class,
        'open_period' => true,
        'close_date' => true,
    ];
    protected $Id;
    protected $Question;
    protected $Options;
    protected $TotalVoterCount;
    protected $IsClosed;
    protected $IsAnonymous;
    protected $Type;
    protected $AllowsMultipleAnswers;
    protected $CorrectOptionId;
    protected $Explanation;
    protected $ExplanationEntities;
    protected $OpenPeriod;
    protected $CloseDate;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}