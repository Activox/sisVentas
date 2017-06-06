<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class AppModel extends ORM
{

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "app";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "field_name_table";
        $this->alias = "app";
        $this->session = \Factory::getSession();
    }

    /**
     * get records of main table.
     * @return type
     */
    public function getApp()
    {
        $this->param1 = "app.id_record";
        $this->param2 = "app.description";
        $this->param3 = "app.icon";
        $this->param4 = "app.url";
        $this->param5 = "app2.description father";
        $this->param6 = "app.id_father";
        $this->param7 = "t.description tipo";
        $this->param8 = "case when app.active = 1 then 'TRUE' else 'FALSE' end active";
        return $this->get()->
            inner("app app2", ["app2.id_record" => "app.id_father"])->
            inner("tipo t", ["t.id_record" => "app.id_tipo"])->
        where(["app.active" => ["operator" => "=", "value" => "1", "nextcondition" => ""]])->
        objectList();
    }

    /**
     * @return object
     */
    public function getAppDescription(){
        $this->param1 = "app.id_record";
        $this->param2 = "upper(app.description) description";
        return $this->get()->
        where(["app.active" => ["operator" => "=", "value" => "1", "nextcondition" => ""]])->
        objectList();
    }

    /**
     * get information by app_id
     * @return type
     */
    public function getAppById($id)
    {
        $this->param1 = "app.id_record";
        $this->param2 = "app.description";
        $this->param3 = "app.icon";
        $this->param4 = "app.url";
        $this->param5 = "app2.description father";
        $this->param6 = "app.id_father";
        $this->param7 = "app.id_tipo";
        $this->param8 = "case when t.active = 1 then 'TRUE' else 'FALSE' end active";
        return $this->get()->
        inner("app app2", ["app2.id_record" => "app.id_father"])->
        where(["app.id_record" => ["operator" => "=", "value" => $id, "nextcondition" => ""]])->
        objectList();
    }

    /**
     * save records.
     * @param stdClass|\stdClass $params
     * @return bool
     */
    public function setApp(\stdClass $params)
    {
        $result = TRUE;
        $this->begin();
        $this->description = $this->escape($params->description);
        $this->icon = $this->escape($params->icon);
        $this->url = $this->escape($params->url);
        $this->id_father = $this->escape($params->id_father);
        $this->created_by = $this->escape($this->session->id_record);
        $id_record = parent::save();
        if ($id_record < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        } else {
            $this->commit();
        }
        return $result;
    }

    /**
     * this function update records
     * @param \stdClass $params
     * @return boolean
     */
    public function updateApp(\stdClass $params)
    {
        $result = TRUE;
        $this->description = $this->escape($params->description);
        $this->icon = $this->escape($params->icon);
        $this->url = $this->escape($params->url);
        $this->id_father = $this->escape($params->id_father);
        $this->created_by = $this->escape($this->session->id_record);
        if ($params->active == "TRUE") {
            $active = 1;
        } else {
            $active = 0;
        }
        $this->active = $this->escape($active);
        $this->value = $this->escape($params->id_record);
        $id_record = parent::update();
        if ($id_record < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        }
        return $result;
    }

}
