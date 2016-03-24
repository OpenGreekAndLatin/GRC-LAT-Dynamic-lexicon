# DynamicLexicon
Ancient Greek/ Latin Dynamic Lexicon

![Alt text](https://cloud.githubusercontent.com/assets/16988264/14022037/40e70d40-f1de-11e5-85d0-905eb478c71e.png)

The goal of this Lexicon is to provide training data for a word alignment system and these data will be used to identify the translation relationships among the words in the parallel texts (Greek/Latin) of the bilingual corpus of the Digital Fragmenta Historicorum Graecorum (DFHG). 


The biggest challenge is that large digitized Ancient Greek/Latin lexica are publicly unavailable. .
This documentation investigates a simple and effective method for automatic bilingual lexicon extraction (Ancient Greek/Latin) from the
available aligned bilingual texts (Ancient Greek/English and Latin/English) produced by the Dynamic Lexicon project of the Perseus Digital Library.

http://tariq-yousef.com/lexica/

The starting point of our approach is to provide as much parallel texts as possible  to extract all possible translation candidates. The Perseus Digital Library contains approximately 10.5 million words of Latin source texts, 13.5 million words of Greek, and 44.5 million words of English. The texts are all public-domain materials that have been scanned, OCR’d, and formatted into TEI-compliant XML 4.

The Perseus Digital Library contains at least one English translation for most of its Latin and Greek prose and poetry texts. Our Corpus consists of 163 parallel documents aligned at the word level (104 Ancient Greek/English documents and 59 Latin/English documents).
The Greek/English dataset consists approximately of 210 thousand sentence pairs with 4.32 million Greek words, whereas the Latin/English dataset consists approximately of 123 thousand sentence pairs with 2.33 million Latin words. The parallel texts are aligned on a sentence level using Moore’s Bilingual Sentence Aligner [6], which aligns the sentences with a very high precision (one-to-one alignment). The Giza++ toolkit is used to align the sentence pairs at the level of individual words.
