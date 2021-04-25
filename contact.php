<?
require "Templates/header.php";
if(!isset($_POST['feedback-form-button']))
{
    ?>
    <h1 class="ta-c">Контакты</h1>
    <form method="post" id="feedback-form" name="feedback-form" action="#">
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="block_11">
            <tbody><tr>
                <td>
                    Ваше имя:
                </td>
                <td><input class="block_10" type="text" maxlength="35" name="name"></td>
            </tr>
            <tr>
                <td>
                    Ваш E-Mail: <span class="require-field">*</span>
                </td>
                <td><input type="email" maxlength="35" name="email" class="block_10"></td>
            </tr>
            <tr>
                <td valign="top">
                    Сообщение: <span class="require-field">*</span>
                </td>
                <td><textarea name="message" style="width: 240px; height: 160px" class="block_13"></textarea></td>
            </tr>
            </tbody>
        </table>
        <button name="feedback-form-button" class="form_button" type="submit" style="position: relative;left: 50%;transform: translate(-50%, 0);">Отправить</button>
    </form>
    <?
}
else
{
    if(mail('igorek.kozlov.1997@gmail.com', 'Сообщение с сайта', $_POST['message'], 'From: '.$_POST['email']. "\r\n")) {
        ?>
        <span>Ваше сообщение отправлено!</span>
        <?
    }
    else
    {
        ?>
        <span>Ваше сообщение не было отправлено!</span>
        <?
    }
}
require "Templates/footer.php";
?>