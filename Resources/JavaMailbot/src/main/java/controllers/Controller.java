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
            new UnpublishExpiredMailsDAO();
        } else if (args.length == 2) {
            new SendMail(args[0], Integer.parseInt(args[1]), con);
        } else {
            System.out.println("Wrong number of parameters.");
            System.exit(1);
        }
    }
}