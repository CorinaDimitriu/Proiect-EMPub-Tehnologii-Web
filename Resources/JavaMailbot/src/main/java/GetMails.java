import javax.mail.*;
import java.io.IOException;

public class GetMails {
    public GetMails(ConnectionProperties con) {
        try {
            Folder mailFolder = con.getStore().getFolder("INBOX");
            mailFolder.open(Folder.READ_ONLY);

            Message[] messages = mailFolder.getMessages();
            for (Message message : messages) {
                Object content = message.getContent();
                StringBuilder wholeContent = new StringBuilder();
                getContent(content, wholeContent);
                StringBuilder aux = new StringBuilder(message.getFrom()[0].toString());
                aux.reverse();
                String email = aux.substring(0, aux.indexOf(" "));
                aux = new StringBuilder(email);
                aux.reverse();
                email = aux.substring(1, aux.length() - 1);
                new SaveMailDAO(email, message.getSubject(), wholeContent.toString());
            }

            mailFolder.close(false);
            con.getStore().close();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void getContent(Object content, StringBuilder wholeContent) throws MessagingException, IOException {
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
