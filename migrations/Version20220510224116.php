<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510224116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookmarks CHANGE provider provider VARCHAR(255) DEFAULT NULL, CHANGE author author VARCHAR(255) DEFAULT NULL, CHANGE date_add date_add DATETIME DEFAULT NULL, CHANGE date_pub date_pub DATETIME DEFAULT NULL, CHANGE width width VARCHAR(255) DEFAULT NULL, CHANGE height height VARCHAR(255) DEFAULT NULL, CHANGE duration duration VARCHAR(255) DEFAULT NULL, CHANGE title title VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookmarks CHANGE provider provider VARCHAR(255) NOT NULL, CHANGE author author VARCHAR(255) NOT NULL, CHANGE date_add date_add DATETIME NOT NULL, CHANGE date_pub date_pub DATETIME NOT NULL, CHANGE width width VARCHAR(255) NOT NULL, CHANGE height height VARCHAR(255) NOT NULL, CHANGE duration duration VARCHAR(255) NOT NULL, CHANGE title title VARCHAR(255) NOT NULL');
    }
}
