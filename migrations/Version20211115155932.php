<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211115155932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advert ADD gallery_id INT DEFAULT NULL, DROP photo_id');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40B4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_54F1F40B4E7AF8F ON advert (gallery_id)');
        $this->addSql('ALTER TABLE photo ADD gallery_id INT NOT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784184E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('CREATE INDEX IDX_14B784184E7AF8F ON photo (gallery_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40B4E7AF8F');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784184E7AF8F');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP INDEX UNIQ_54F1F40B4E7AF8F ON advert');
        $this->addSql('ALTER TABLE advert ADD photo_id INT NOT NULL, DROP gallery_id');
        $this->addSql('DROP INDEX IDX_14B784184E7AF8F ON photo');
        $this->addSql('ALTER TABLE photo DROP gallery_id');
    }
}
