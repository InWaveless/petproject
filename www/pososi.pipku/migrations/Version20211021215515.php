<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211021215515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT fk_dadd4a254faf8f53');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT fk_dadd4a257ea8aaa3');
        $this->addSql('DROP INDEX idx_dadd4a254faf8f53');
        $this->addSql('DROP INDEX idx_dadd4a257ea8aaa3');
        $this->addSql('ALTER TABLE answer RENAME COLUMN question_id_id TO question_id');
        $this->addSql('ALTER TABLE answer RENAME COLUMN question_next_id_id TO question_next_id');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25A4FF23D5 FOREIGN KEY (question_next_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A25A4FF23D5 ON answer (question_next_id)');
        $this->addSql('ALTER TABLE company DROP CONSTRAINT fk_4fbf094fa47b0a00');
        $this->addSql('DROP INDEX idx_4fbf094fa47b0a00');
        $this->addSql('ALTER TABLE company RENAME COLUMN company_poll_id_id TO company_poll_id');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F1CC666D8 FOREIGN KEY (company_poll_id) REFERENCES company_poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4FBF094F1CC666D8 ON company (company_poll_id)');
        $this->addSql('ALTER TABLE company_poll DROP CONSTRAINT fk_c7d1e0ab19f5e396');
        $this->addSql('DROP INDEX idx_c7d1e0ab19f5e396');
        $this->addSql('ALTER TABLE company_poll RENAME COLUMN poll_id_id TO poll_id');
        $this->addSql('ALTER TABLE company_poll ADD CONSTRAINT FK_C7D1E0AB979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll ADD CONSTRAINT FK_C7D1E0AB3C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C7D1E0AB979B1AD6 ON company_poll (company_id)');
        $this->addSql('CREATE INDEX IDX_C7D1E0AB3C947C0F ON company_poll (poll_id)');
        $this->addSql('ALTER TABLE company_poll_answer DROP CONSTRAINT fk_2f09b1e6a47b0a00');
        $this->addSql('ALTER TABLE company_poll_answer DROP CONSTRAINT fk_2f09b1e64faf8f53');
        $this->addSql('ALTER TABLE company_poll_answer DROP CONSTRAINT fk_2f09b1e6e47e7704');
        $this->addSql('DROP INDEX idx_2f09b1e64faf8f53');
        $this->addSql('DROP INDEX idx_2f09b1e6e47e7704');
        $this->addSql('DROP INDEX idx_2f09b1e6a47b0a00');
        $this->addSql('ALTER TABLE company_poll_answer ADD company_poll_id INT NOT NULL');
        $this->addSql('ALTER TABLE company_poll_answer ADD question_id INT NOT NULL');
        $this->addSql('ALTER TABLE company_poll_answer ADD answer_id INT NOT NULL');
        $this->addSql('ALTER TABLE company_poll_answer DROP company_poll_id_id');
        $this->addSql('ALTER TABLE company_poll_answer DROP question_id_id');
        $this->addSql('ALTER TABLE company_poll_answer DROP answer_id_id');
        $this->addSql('ALTER TABLE company_poll_answer ADD CONSTRAINT FK_2F09B1E61CC666D8 FOREIGN KEY (company_poll_id) REFERENCES company_poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll_answer ADD CONSTRAINT FK_2F09B1E61E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll_answer ADD CONSTRAINT FK_2F09B1E6AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2F09B1E61CC666D8 ON company_poll_answer (company_poll_id)');
        $this->addSql('CREATE INDEX IDX_2F09B1E61E27F6BF ON company_poll_answer (question_id)');
        $this->addSql('CREATE INDEX IDX_2F09B1E6AA334807 ON company_poll_answer (answer_id)');
        $this->addSql('ALTER TABLE company_poll_question DROP CONSTRAINT fk_7c4f1383a47b0a00');
        $this->addSql('ALTER TABLE company_poll_question DROP CONSTRAINT fk_7c4f13834faf8f53');
        $this->addSql('DROP INDEX idx_7c4f13834faf8f53');
        $this->addSql('DROP INDEX idx_7c4f1383a47b0a00');
        $this->addSql('ALTER TABLE company_poll_question RENAME COLUMN company_poll_id_id TO company_poll_id');
        $this->addSql('ALTER TABLE company_poll_question RENAME COLUMN question_id_id TO question_id');
        $this->addSql('ALTER TABLE company_poll_question ADD CONSTRAINT FK_7C4F13831CC666D8 FOREIGN KEY (company_poll_id) REFERENCES company_poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll_question ADD CONSTRAINT FK_7C4F13831E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7C4F13831CC666D8 ON company_poll_question (company_poll_id)');
        $this->addSql('CREATE INDEX IDX_7C4F13831E27F6BF ON company_poll_question (question_id)');
        $this->addSql('ALTER TABLE poll DROP CONSTRAINT fk_84bcfa45a5fdb53d');
        $this->addSql('DROP INDEX idx_84bcfa45a5fdb53d');
        $this->addSql('ALTER TABLE poll RENAME COLUMN first_question_id_id TO first_question_id');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT FK_84BCFA4580D2FB7D FOREIGN KEY (first_question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_84BCFA4580D2FB7D ON poll (first_question_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A25A4FF23D5');
        $this->addSql('DROP INDEX IDX_DADD4A251E27F6BF');
        $this->addSql('DROP INDEX IDX_DADD4A25A4FF23D5');
        $this->addSql('ALTER TABLE answer RENAME COLUMN question_id TO question_id_id');
        $this->addSql('ALTER TABLE answer RENAME COLUMN question_next_id TO question_next_id_id');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT fk_dadd4a254faf8f53 FOREIGN KEY (question_id_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT fk_dadd4a257ea8aaa3 FOREIGN KEY (question_next_id_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_dadd4a254faf8f53 ON answer (question_id_id)');
        $this->addSql('CREATE INDEX idx_dadd4a257ea8aaa3 ON answer (question_next_id_id)');
        $this->addSql('ALTER TABLE poll DROP CONSTRAINT FK_84BCFA4580D2FB7D');
        $this->addSql('DROP INDEX IDX_84BCFA4580D2FB7D');
        $this->addSql('ALTER TABLE poll RENAME COLUMN first_question_id TO first_question_id_id');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT fk_84bcfa45a5fdb53d FOREIGN KEY (first_question_id_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_84bcfa45a5fdb53d ON poll (first_question_id_id)');
        $this->addSql('ALTER TABLE company_poll DROP CONSTRAINT FK_C7D1E0AB979B1AD6');
        $this->addSql('ALTER TABLE company_poll DROP CONSTRAINT FK_C7D1E0AB3C947C0F');
        $this->addSql('DROP INDEX IDX_C7D1E0AB979B1AD6');
        $this->addSql('DROP INDEX IDX_C7D1E0AB3C947C0F');
        $this->addSql('ALTER TABLE company_poll RENAME COLUMN poll_id TO poll_id_id');
        $this->addSql('ALTER TABLE company_poll ADD CONSTRAINT fk_c7d1e0ab19f5e396 FOREIGN KEY (poll_id_id) REFERENCES poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c7d1e0ab19f5e396 ON company_poll (poll_id_id)');
        $this->addSql('ALTER TABLE company_poll_answer DROP CONSTRAINT FK_2F09B1E61CC666D8');
        $this->addSql('ALTER TABLE company_poll_answer DROP CONSTRAINT FK_2F09B1E61E27F6BF');
        $this->addSql('ALTER TABLE company_poll_answer DROP CONSTRAINT FK_2F09B1E6AA334807');
        $this->addSql('DROP INDEX IDX_2F09B1E61CC666D8');
        $this->addSql('DROP INDEX IDX_2F09B1E61E27F6BF');
        $this->addSql('DROP INDEX IDX_2F09B1E6AA334807');
        $this->addSql('ALTER TABLE company_poll_answer ADD company_poll_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE company_poll_answer ADD question_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE company_poll_answer ADD answer_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE company_poll_answer DROP company_poll_id');
        $this->addSql('ALTER TABLE company_poll_answer DROP question_id');
        $this->addSql('ALTER TABLE company_poll_answer DROP answer_id');
        $this->addSql('ALTER TABLE company_poll_answer ADD CONSTRAINT fk_2f09b1e6a47b0a00 FOREIGN KEY (company_poll_id_id) REFERENCES company_poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll_answer ADD CONSTRAINT fk_2f09b1e64faf8f53 FOREIGN KEY (question_id_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll_answer ADD CONSTRAINT fk_2f09b1e6e47e7704 FOREIGN KEY (answer_id_id) REFERENCES answer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2f09b1e64faf8f53 ON company_poll_answer (question_id_id)');
        $this->addSql('CREATE INDEX idx_2f09b1e6e47e7704 ON company_poll_answer (answer_id_id)');
        $this->addSql('CREATE INDEX idx_2f09b1e6a47b0a00 ON company_poll_answer (company_poll_id_id)');
        $this->addSql('ALTER TABLE company_poll_question DROP CONSTRAINT FK_7C4F13831CC666D8');
        $this->addSql('ALTER TABLE company_poll_question DROP CONSTRAINT FK_7C4F13831E27F6BF');
        $this->addSql('DROP INDEX IDX_7C4F13831CC666D8');
        $this->addSql('DROP INDEX IDX_7C4F13831E27F6BF');
        $this->addSql('ALTER TABLE company_poll_question RENAME COLUMN company_poll_id TO company_poll_id_id');
        $this->addSql('ALTER TABLE company_poll_question RENAME COLUMN question_id TO question_id_id');
        $this->addSql('ALTER TABLE company_poll_question ADD CONSTRAINT fk_7c4f1383a47b0a00 FOREIGN KEY (company_poll_id_id) REFERENCES company_poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll_question ADD CONSTRAINT fk_7c4f13834faf8f53 FOREIGN KEY (question_id_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_7c4f13834faf8f53 ON company_poll_question (question_id_id)');
        $this->addSql('CREATE INDEX idx_7c4f1383a47b0a00 ON company_poll_question (company_poll_id_id)');
        $this->addSql('ALTER TABLE company DROP CONSTRAINT FK_4FBF094F1CC666D8');
        $this->addSql('DROP INDEX IDX_4FBF094F1CC666D8');
        $this->addSql('ALTER TABLE company RENAME COLUMN company_poll_id TO company_poll_id_id');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT fk_4fbf094fa47b0a00 FOREIGN KEY (company_poll_id_id) REFERENCES company_poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_4fbf094fa47b0a00 ON company (company_poll_id_id)');
    }
}
