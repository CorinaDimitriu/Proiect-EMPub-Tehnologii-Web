import javax.mail.*;
import java.io.IOException;
import java.util.Properties;

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

            for (Message message : messages) {
                Object content = message.getContent();
                StringBuilder wholeContent = new StringBuilder();
                getContent(content, wholeContent);
                StringBuilder aux = new StringBuilder(message.getFrom()[0].toString());
                aux.reverse(); String email = aux.substring(0, aux.indexOf(" "));
                aux = new StringBuilder(email); aux.reverse(); email = aux.substring(1,aux.length() - 1);
                SaveMailDAO.saveInDatabase(email, message.getSubject(), wholeContent.toString());
            }

            //close the store and folder objects
            emailFolder.close(false);
            store.close();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private static void getContent(Object content, StringBuilder wholeContent) throws MessagingException, IOException {
        if (content instanceof Multipart mp)
            for (int i = 0; i < mp.getCount(); i++) {
                BodyPart bp = mp.getBodyPart(i);
                if (bp.isMimeType("text/html")) {
                    wholeContent.append(bp.getContent());
                } else if (bp.isMimeType("multipart/*")) {
                    getContent(bp, wholeContent);
                }
            }
        else if (content instanceof String s)
            wholeContent.append(s);
    }
}