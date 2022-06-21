package controllers;

import auxiliary.ConnectionProperties;

import javax.mail.MessagingException;

public class Controller {
    public void decideAction(String[] args) throws MessagingException {
        String username = "emailpublisher1@gmail.com";
        String password = "smkzskskfganhqhs";

        ConnectionProperties con = new ConnectionProperties(username, password);
        if (args.length == 0) {
            new GetMails(con);
        } else if (args.length == 1) {
            new UnpublishedExpiredMailsDAO();
        } else if (args.length == 3) {
            new SendMail(args[0], args[1], args[2], con);
        } else {
            System.out.println("Wrong number of parameters.");
            System.exit(1);
        }
    }
}