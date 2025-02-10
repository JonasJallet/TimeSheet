<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204101816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE time_sheet (id SERIAL NOT NULL, year INT NOT NULL, month INT NOT NULL, hour_balance DOUBLE PRECISION NOT NULL, teleworking_counter INT NOT NULL, working_days INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE users (id SERIAL NOT NULL, default_work_hour_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9C808BA5A ON users (last_name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9428E2671 ON users (default_work_hour_id)');
        $this->addSql('CREATE TABLE work_hour_default (id SERIAL NOT NULL, morning_start_time TIME(0) WITHOUT TIME ZONE NOT NULL, morning_end_time TIME(0) WITHOUT TIME ZONE NOT NULL, afternoon_start_time TIME(0) WITHOUT TIME ZONE NOT NULL, afternoon_end_time TIME(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE working_day (id SERIAL NOT NULL, morning_working_day TIME(0) WITHOUT TIME ZONE NOT NULL, afternoon_working_day TIME(0) WITHOUT TIME ZONE NOT NULL, working_day_type_enum VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9428E2671 FOREIGN KEY (default_work_hour_id) REFERENCES work_hour_default (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E9428E2671');
        $this->addSql('DROP TABLE time_sheet');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE work_hour_default');
        $this->addSql('DROP TABLE working_day');
    }
}
