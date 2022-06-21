package controllers;

import auxiliary.ConnectionProperties;

import javax.mail.*;
import javax.mail.internet.*;
import java.util.Date;

public class SendMail {
    public SendMail(String toAddress, String verificationCode, String officialCode, ConnectionProperties con) throws MessagingException {
        String subject = "Cod verificare";
        String message = "Codul de verificare pentru autentificarea la EmPub este: " + officialCode + ".";

        Message mail = new MimeMessage(con.getMailSession());
        mail.setFrom(new InternetAddress(con.getUsername()));
        mail.setRecipient(Message.RecipientType.TO, new InternetAddress(toAddress));
        mail.setSubject(subject);
        mail.setSentDate(new Date());

        Multipart multipart = new MimeMultipart();

        MimeBodyPart messageBodyPart = new MimeBodyPart();
        messageBodyPart.setContent(message, "text/html");

        multipart.addBodyPart(messageBodyPart);

        mail.setContent(multipart);

        Transport.send(mail);

        con.getStore().close();
        new SaveCodeDAO(toAddress,verificationCode);
    }
}