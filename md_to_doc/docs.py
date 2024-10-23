from spire.doc import *
from spire.doc.common import *

doc_name = 'steps to store passwords in environment variables.md'
# s = doc_name[: -3]
document = Document()
document.LoadFromFile(doc_name)

document.SaveToFile(f'{doc_name[: -3]}.docx', FileFormat.Docx)
document.SaveToFile(f'{doc_name[: -3]}.pdf', FileFormat.PDF)
# document.SaveToFile("MdToDoc.doc", FileFormat.Doc)
document.Close()
