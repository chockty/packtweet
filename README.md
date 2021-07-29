| テーブル論理名 | テーブル物理名 |
|:--|:--|
| ツイート | tweets | 


| # | PK  | UK  | カラム論理名     | カラム物理名      | データ型       | 桁 | NULL | DEFAULT  | 備考 |
|:--|:--|:--|:--|:--|:--|:--|:--|:--|:--|
| 1 | ○   | N/A | ツイートid       | id             | INT unsigned | N/A | NO   | auto_increment      | |
| 2 | N/A | N/A | ユーザid        | user_id         | INT unsigned | N/A | NO  | N/A                    | |
| 3 | N/A | N/A | 内容           | content         | TEXT         | 140 | NO   | N/A            |               | 
| 4 | N/A | N/A | 作成日時        | created_at      | TIMESTAMP   | N/A  | YES  | N/A                | | 
| 5 | N/A | N/A | 更新日時        | updated_at      | TIMESTAMP   | N/A  | YES  | N/A             | |
| 6 | N/A | N/A | 削除日時        | deleted_at      | TIMESTAMP   | N/A  | YES  | N/A            | |

<br />

| テーブル論理名 | テーブル物理名 |
|:--|:--|
| ユーザ | users | 


| # | PK  | UK  | カラム論理名     | カラム物理名 | データ型       | 桁   | NULL   | DEFAULT   | 備考 |
|:--|:--|:--|:--|:--|:--|:--|:--|:--|:--|
| 1 | ○   | N/A | ユーザid      | id          | INT unsigned | N/A | NO     | auto_increment |             |
| 2 | N/A | N/A | ユーザ名       | name     | VARCHAR | 255 | NO     | N/A |                               |
| 3 | N/A | ○   | メールアドレス   | email  | VARCHAR | 255 | NO     | N/A |                              |
| 4 | N/A | N/A | パスワード      | password | VARCHAR      | 50 | NO     | N/A |                                    |
| 5 | N/A | N/A | 作成日時      | created_at  | TIMESTAMP   | N/A  | YES     | N/A             |               |
| 6 | N/A | N/A | 更新日時      | updated_at  | TIMESTAMP   | N/A  | YES     | N/A             |             |
| 7 | N/A | N/A | 削除日時      | deleted_at  | TIMESTAMP   | N/A  | YES     | N/A             |               |

<br />

| テーブル論理名 | テーブル物理名 |
|:--|:--|
| ユーザ | comments | 


| # | PK  | UK  | カラム論理名     | カラム物理名 | データ型       | 桁   | NULL   | DEFAULT   | 備考 |
|:--|:--|:--|:--|:--|:--|:--|:--|:--|:--|
| 1 | ○   | N/A | コメントid       | id             | INT unsigned | N/A | NO   | auto_increment      | |
| 1 | N/A | N/A | ユーザid      | user_id          | INT unsigned | N/A | NO     | N/A |             |
| 2 | N/A | N/A | ツイートid      | tweet_id          | INT unsigned | N/A | NO     | N/A |             |
| 3 | N/A | N/A | 内容           | content         | TEXT         | 140 | NO   | N/A            |               | 
| 4 | N/A | N/A | 作成日時      | created_at  | TIMESTAMP   | N/A  | YES     | N/A             |               |
| 5 | N/A | N/A | 更新日時      | updated_at  | TIMESTAMP   | N/A  | YES     | N/A             |             |

※ユーザidとツイートidの組み合わせは一意性を保つ