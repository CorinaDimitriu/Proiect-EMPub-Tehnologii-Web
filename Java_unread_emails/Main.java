import javax.mail.*;
import java.util.Properties;
import java.util.regex.Pattern;

//POP3 supports only a single folder named "INBOX".
//vede doar email-urile necitite
//cont google -> security -> less secure app access on

public class Main {
    public static void main(String[] args) {

        String host = "pop.gmail.com";
        String username = "emailpublisher1@gmail.com";
        String password = "smkzskskfganhqhs";

        connect(host, username, password);
    }

    public static void connect(String host, String user, String password) {
        try {

            //create properties field
            Properties properties = new Properties();

            properties.put("mail.pop3.host", host);
            properties.put("mail.pop3.port", "995");
            properties.put("mail.pop3.starttls.enable", "true");
            Session emailSession = Session.getDefaultInstance(properties, null);

            //create the POP3 store object and connect with the pop server
            Store store = emailSession.getStore("pop3s");

            store.connect(host, user, password);

            //create the folder object and open it
            Folder emailFolder = store.getFolder("INBOX");
            emailFolder.open(Folder.READ_ONLY);

            // retrieve the messages from the folder in an array and print it
            Message[] messages = emailFolder.getMessages();
            System.out.println("messages.length = " + messages.length);

            for (int i = 0, n = messages.length; i < n; i++) {
                Message message = messages[i];
                System.out.println("---------------------------------");
                System.out.println("Email Number " + (i + 1));
                System.out.println("Subject: " + message.getSubject());
                System.out.println("From: " + message.getFrom()[0]);
                System.out.println("Text: " + message.getContent().toString());
                Object content = message.getContent();
                if (content instanceof Multipart mp) {
                    for (int j = 0; j < mp.getCount(); j++) {
                        BodyPart bp = mp.getBodyPart(j);
                        if (Pattern
                                .compile(Pattern.quote("text/html"), Pattern.CASE_INSENSITIVE)
                                .matcher(bp.getContentType()).find()) {
                            // found html part
                            System.out.println((String) bp.getContent());
                        } else {
                            System.out.println("some other body part..");
                        }
                    }
                }
            }

            //close the store and folder objects
            emailFolder.close(false);
            store.close();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
