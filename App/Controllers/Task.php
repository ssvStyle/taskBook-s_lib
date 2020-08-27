<?php
namespace App\Controllers;
use Core\BaseController;

class Task extends BaseController
{
    /**
     * @return view
     */
    public function add()
    {
        var_dump($_POST);
        echo $this->view->display('addNewTask.html', [
            'name' => 'ssv',
            'email' => 'ssv@gmail.ua',
            'task' => 'Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney, штат Вирджиния, взял одно из самых странных слов в Lorem Ipsum, "consectetur", и занялся его поисками в классической латинской литературе. В результате он нашёл неоспоримый первоисточник'
        ]);
    }

    /**
     * @param mixed $data
     */
    public function edit()
    {
        echo $this->view->display('addNewTask.html');
    }

}