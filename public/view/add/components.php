<?php
class ComponentsAp
{

    public function buttonSend($text, $id)
    {
        echo
        '
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary " id="' . $id . '">
                    ' . $text . '
                </button>
            </div>';
    }
    
    public function inputCreate($text = '', $class = '', $name = '', $id = '', $value = '')
    {
        echo '
            <div class="col-12">
                <div class="input-group input-group-sm ">
                    <span class="input-group-text">' . $text . '</span>
                    <input type="text" class="form-control form-control-sm ' . $class . '" value="' . $value . '" name="' . $name . '" id="' . $id . '" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                </div>
            </div>
        ';
    }
}
