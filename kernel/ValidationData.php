<?php


namespace kernel;


class ValidationData
{
    protected $rules    = [];
    protected $fields   = [];
    protected $messages = [];
    protected $hasError = false;
    protected $response = [];

    const DEFAULT_REQUIRED_MSG   = "Field ':field:' is required";
    const DEFAULT_INTEGER_MSG    = "Field ':field:' must be integer";
    const DEFAULT_FLOAT_MSG      = "Field ':field:' must be float";
    const DEFAULT_STRING_MSG     = "Field ':field:' must be string";
    const DEFAULT_EMAIL_MSG      = "Field ':field:' must be valid email address";
    const DEFAULT_MIN_LENGTH_MSG = "Field ':field:' must be greater than :min: characters";
    const DEFAULT_MAX_LENGTH_MSG = "Field ':field:' must be less than :max: characters";
    const DEFAULT_REGEXP_MSG     = "Field ':field:' must match :regexp:";

    const VALIDATE_REQUIRED = 'required';
    const VALIDATE_INTEGER  = 'integer';
    const VALIDATE_FLOAT    = 'float';
    const VALIDATE_STRING   = 'string';
    const VALIDATE_EMAIL    = 'email';
    const VALIDATE_REGEXP   = 'regexp';

    /**
     * Set validate data
     *
     * @param array $data
     *
     * @return ValidationData
     */
    public function setData(array $data)
    {
        $this->fields = $data;

        return $this;
    }

    /**
     * Set validate rules
     *
     * @param array $rules
     *
     * @return $this
     */
    public function addRules(array $rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        foreach ($this->rules as $params) {
            $fields = array_shift($params);
            $rule   = array_shift($params);

            if (is_array($fields)) {
                foreach ($fields as $field) {
                    $this->apply($field, $rule, $params);
                    $this->response[$field] = $this->fields[$field];
                }
            } else {
                $this->apply($fields, $rule, $params);
                $this->response[$fields] = $this->fields[$fields];
            }
        }

        return !$this->hasErrors();
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param $field
     *
     * @return mixed
     */
    public function getMessage($field)
    {
        return $this->messages[$field];
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return $this->hasError;
    }

    public function getData()
    {
        return $this->response;
    }

    /**
     * @param $field
     * @param $rule
     * @param $params
     */
    protected function apply($field, $rule, $params)
    {
        switch ($rule) {
            case "required":
                $this->checkRequired($field, $params['message'] ?? null);
                break;
            case "integer":
                $this->checkInteger($field, $params['message'] ?? null);
                break;
            case "float":
                $this->checkFloat($field, $params['message'] ?? null);
                break;
            case "string":
                $this->checkString($field, $params['message'] ?? null);
                $this->checkLength($field, $params['min'] ?? null, $params['max'] ?? null, $params['message'] ?? null);
                break;
            case "email":
                $this->checkEmail($field, $params['message'] ?? null);
                break;
            case "regexp":
                $this->checkRegEx($field, $params['pattern'], $params['message'] ?? null);
                break;
        }
    }

    /**
     * @param $field
     * @param $message
     */
    protected function checkRequired($field, $message)
    {
        if (!isset($this->fields[$field]) || strlen($this->fields[$field]) <= 0) {
            $message = $this->setMessage($message ?? self::DEFAULT_REQUIRED_MSG, [':field:' => $field]);

            $this->messages[$field][] = $message;
            $this->hasError           = true;
        }
    }

    /**
     * @param $field
     * @param $message
     */
    protected function checkInteger($field, $message)
    {
        if (isset($this->fields[$field]) && (!is_numeric($this->fields[$field]) || !is_int((int)$this->fields[$field]))) {
            $message = $this->setMessage($message ?? self::DEFAULT_INTEGER_MSG, [':field:' => $field]);

            $this->messages[$field][] = $message;
            $this->hasError           = true;

        }
    }

    /**
     * @param $field
     * @param $message
     */
    protected function checkFloat($field, $message)
    {
        if (isset($this->fields[$field]) && (!is_numeric($this->fields[$field]) || !is_float((float)$this->fields[$field]))) {
            $message = $this->setMessage($message ?? self::DEFAULT_FLOAT_MSG, [':field:' => $field]);

            $this->messages[$field][] = $message;
            $this->hasError           = true;
        }
    }

    /**
     * @param $field
     * @param $message
     */
    protected function checkString($field, $message)
    {
        if (isset($this->fields[$field]) && !is_string($this->fields[$field])) {
            $message = $this->setMessage($message ?? self::DEFAULT_STRING_MSG, [':field:' => $field]);

            $this->messages[$field][] = $message;
            $this->hasError           = true;
        }
    }

    /**
     * @param      $field
     * @param null $min
     * @param null $max
     * @param      $message
     */
    protected function checkLength($field, $min = null, $max = null, $message = null)
    {
        if (isset($this->fields[$field])) {
            if ($min && mb_strlen($this->fields[$field]) < $min) {
                $message = $this->setMessage($message ?? self::DEFAULT_MIN_LENGTH_MSG, [
                    ':field:' => $field,
                    ':min:'   => $min,
                    ':max:'   => $max,
                ]);

                $this->messages[$field][] = $message;
                $this->hasError           = true;
            }

            if ($max && mb_strlen($this->fields[$field]) > $max) {
                $message = $this->setMessage($message ?? self::DEFAULT_MAX_LENGTH_MSG, [
                    ':field:' => $field,
                    ':min:'   => $min,
                    ':max:'   => $max,
                ]);

                $this->messages[$field][] = $message;
                $this->hasError           = true;
            }
        }
    }

    /**
     * @param $field
     * @param $regexp
     * @param $message
     */
    protected function checkRegEx($field, $regexp, $message)
    {
        if (isset($this->fields[$field]) && !preg_match($regexp, $this->fields[$field])) {
            $message = $this->setMessage($message ?? self::DEFAULT_REGEXP_MSG, [
                ':field:'  => $field,
                ':regexp:' => $regexp,
            ]);

            $this->messages[$field][] = $message;
            $this->hasError           = true;
        }
    }

    /**
     * @param $field
     * @param $message
     */
    protected function checkEmail($field, $message)
    {
        if (isset($this->fields[$field]) && !filter_var($this->fields[$field], FILTER_VALIDATE_EMAIL)) {
            $message = $this->setMessage($message ?? self::DEFAULT_EMAIL_MSG, [':field:' => $field]);

            $this->messages[$field][] = $message;
            $this->hasError           = true;
        }
    }

    /**
     * @param $message
     * @param $replace
     *
     * @return mixed
     */
    protected function setMessage($message, $replace)
    {
        $replace[':value:'] = $replace[':value:'] ?? ($this->fields[$replace[':field:']] ?? null);

        foreach ($replace as $placeholder => $field) {
            $message = str_replace($placeholder, $field, $message);
        }

        return $message;
    }
}
