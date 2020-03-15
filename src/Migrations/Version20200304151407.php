<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200304151407 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card ADD maker_id INT DEFAULT NULL, DROP maker');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D368DA5EC3 FOREIGN KEY (maker_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_161498D368DA5EC3 ON card (maker_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D368DA5EC3');
        $this->addSql('DROP INDEX IDX_161498D368DA5EC3 ON card');
        $this->addSql('ALTER TABLE card ADD maker VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP maker_id');
    }
}