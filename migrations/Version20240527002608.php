<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240527002608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE metal_price_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE metal (symbol VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(symbol))');
        $this->addSql('CREATE TABLE metal_price (id INT NOT NULL, metal_symbol VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, registered_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CB23DE6C57C29A06 ON metal_price (metal_symbol)');
        $this->addSql('COMMENT ON COLUMN metal_price.registered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE metal_price ADD CONSTRAINT FK_CB23DE6C57C29A06 FOREIGN KEY (metal_symbol) REFERENCES metal (symbol) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE metal_price_id_seq CASCADE');
        $this->addSql('ALTER TABLE metal_price DROP CONSTRAINT FK_CB23DE6C57C29A06');
        $this->addSql('DROP TABLE metal');
        $this->addSql('DROP TABLE metal_price');
    }
}
