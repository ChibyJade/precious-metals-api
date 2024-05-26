<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240526234115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE metal_price_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE metal (iso4217_code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(iso4217_code))');
        $this->addSql('CREATE TABLE metal_price (id INT NOT NULL, metal_iso4217_code VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, registered_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CB23DE6C31EB3884 ON metal_price (metal_iso4217_code)');
        $this->addSql('COMMENT ON COLUMN metal_price.registered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE metal_price ADD CONSTRAINT FK_CB23DE6C31EB3884 FOREIGN KEY (metal_iso4217_code) REFERENCES metal (iso4217_code) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE metal_price_id_seq CASCADE');
        $this->addSql('ALTER TABLE metal_price DROP CONSTRAINT FK_CB23DE6C31EB3884');
        $this->addSql('DROP TABLE metal');
        $this->addSql('DROP TABLE metal_price');
    }
}
