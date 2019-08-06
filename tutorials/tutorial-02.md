# Tutorial 2: Normalisation Exercise

List Attributes

```
STUDENT(**id**, name, address, phone, mentor_name, mentor_contact, (year, sem, subj_id, desc, mark, grade))
```

1NF (First Normal Form) - List attributes, PK, remove repeating groups

```
STUDENT(**id**, name, address, phone, mentor_name, mentor_contact)
STUDENT_RESULT(**id**, **year**, **semester**, **subject**, description, mark, grade)
```

2NF (Second Normal Form) - Remove partial dependencies

```
STUDENT(**id**, name, address, phone, mentor_name, mentor_contact)
STUDENT_RESULT(**id**, **year**, **semester**, **subject**, mark, grade)
SUBJECT(**code**, description)
```

3NF (Third Normal Form - Remove transitive dependencies

```
STUDENT(**id**, name, address, phone, mentor_id)
STUDENT_RESULT(**id**, **year**, **semester**, **subject**, mark, grade)
SUBJECT(**code**, description)
MENTOR(**id**, name, contact)
```
