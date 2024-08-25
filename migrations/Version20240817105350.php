<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240817105350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE permission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE permission (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE permission_role (permission_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(permission_id, role_id))');
        $this->addSql('CREATE INDEX IDX_6A711CAFED90CCA ON permission_role (permission_id)');
        $this->addSql('CREATE INDEX IDX_6A711CAD60322AC ON permission_role (role_id)');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_role (id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_role_role (user_role_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(user_role_id, role_id))');
        $this->addSql('CREATE INDEX IDX_E936751A8E0E3CA6 ON user_role_role (user_role_id)');
        $this->addSql('CREATE INDEX IDX_E936751AD60322AC ON user_role_role (role_id)');
        $this->addSql('ALTER TABLE permission_role ADD CONSTRAINT FK_6A711CAFED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE permission_role ADD CONSTRAINT FK_6A711CAD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_role_role ADD CONSTRAINT FK_E936751A8E0E3CA6 FOREIGN KEY (user_role_id) REFERENCES user_role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_role_role ADD CONSTRAINT FK_E936751AD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE permission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_role_id_seq CASCADE');
        $this->addSql('ALTER TABLE permission_role DROP CONSTRAINT FK_6A711CAFED90CCA');
        $this->addSql('ALTER TABLE permission_role DROP CONSTRAINT FK_6A711CAD60322AC');
        $this->addSql('ALTER TABLE user_role_role DROP CONSTRAINT FK_E936751A8E0E3CA6');
        $this->addSql('ALTER TABLE user_role_role DROP CONSTRAINT FK_E936751AD60322AC');
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE permission_role');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP TABLE user_role_role');
    }
}
