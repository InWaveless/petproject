<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211020023522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE company_poll_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE company_poll_answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE company_poll_question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE poll_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE answer (id INT NOT NULL, question_id_id INT NOT NULL, question_next_id_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DADD4A254FAF8F53 ON answer (question_id_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A257EA8AAA3 ON answer (question_next_id_id)');
        $this->addSql('CREATE TABLE company_poll (id INT NOT NULL, poll_id_id INT NOT NULL, company_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, actual_before TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, finished BOOLEAN NOT NULL, show_after TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, try_count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C7D1E0AB19F5E396 ON company_poll (poll_id_id)');
        $this->addSql('COMMENT ON COLUMN company_poll.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN company_poll.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN company_poll.actual_before IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN company_poll.show_after IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE company_poll_answer (id INT NOT NULL, company_poll_id_id INT NOT NULL, question_id_id INT NOT NULL, answer_id_id INT NOT NULL, meta JSON DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2F09B1E6A47B0A00 ON company_poll_answer (company_poll_id_id)');
        $this->addSql('CREATE INDEX IDX_2F09B1E64FAF8F53 ON company_poll_answer (question_id_id)');
        $this->addSql('CREATE INDEX IDX_2F09B1E6E47E7704 ON company_poll_answer (answer_id_id)');
        $this->addSql('COMMENT ON COLUMN company_poll_answer.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE company_poll_question (id INT NOT NULL, company_poll_id_id INT NOT NULL, question_id_id INT DEFAULT NULL, answered BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7C4F1383A47B0A00 ON company_poll_question (company_poll_id_id)');
        $this->addSql('CREATE INDEX IDX_7C4F13834FAF8F53 ON company_poll_question (question_id_id)');
        $this->addSql('COMMENT ON COLUMN company_poll_question.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN company_poll_question.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE poll (id INT NOT NULL, first_question_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_84BCFA45A5FDB53D ON poll (first_question_id_id)');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A254FAF8F53 FOREIGN KEY (question_id_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A257EA8AAA3 FOREIGN KEY (question_next_id_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll ADD CONSTRAINT FK_C7D1E0AB19F5E396 FOREIGN KEY (poll_id_id) REFERENCES poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll_answer ADD CONSTRAINT FK_2F09B1E6A47B0A00 FOREIGN KEY (company_poll_id_id) REFERENCES company_poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll_answer ADD CONSTRAINT FK_2F09B1E64FAF8F53 FOREIGN KEY (question_id_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll_answer ADD CONSTRAINT FK_2F09B1E6E47E7704 FOREIGN KEY (answer_id_id) REFERENCES answer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll_question ADD CONSTRAINT FK_7C4F1383A47B0A00 FOREIGN KEY (company_poll_id_id) REFERENCES company_poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_poll_question ADD CONSTRAINT FK_7C4F13834FAF8F53 FOREIGN KEY (question_id_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT FK_84BCFA45A5FDB53D FOREIGN KEY (first_question_id_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE company_poll_answer DROP CONSTRAINT FK_2F09B1E6E47E7704');
        $this->addSql('ALTER TABLE company_poll_answer DROP CONSTRAINT FK_2F09B1E6A47B0A00');
        $this->addSql('ALTER TABLE company_poll_question DROP CONSTRAINT FK_7C4F1383A47B0A00');
        $this->addSql('ALTER TABLE company_poll DROP CONSTRAINT FK_C7D1E0AB19F5E396');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A254FAF8F53');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A257EA8AAA3');
        $this->addSql('ALTER TABLE company_poll_answer DROP CONSTRAINT FK_2F09B1E64FAF8F53');
        $this->addSql('ALTER TABLE company_poll_question DROP CONSTRAINT FK_7C4F13834FAF8F53');
        $this->addSql('ALTER TABLE poll DROP CONSTRAINT FK_84BCFA45A5FDB53D');
        $this->addSql('DROP SEQUENCE answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE company_poll_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE company_poll_answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE company_poll_question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE poll_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE company_poll');
        $this->addSql('DROP TABLE company_poll_answer');
        $this->addSql('DROP TABLE company_poll_question');
        $this->addSql('DROP TABLE poll');
        $this->addSql('DROP TABLE question');
    }
}
