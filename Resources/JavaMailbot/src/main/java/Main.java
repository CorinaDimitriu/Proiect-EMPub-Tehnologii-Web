import controllers.Controller;

import javax.mail.MessagingException;

public class Main {
    public static void main(String[] args) {
        Controller controller = new Controller();
        try {
            controller.decideAction(args);
        } catch (MessagingException e) {
            e.printStackTrace();
        }
    }
}