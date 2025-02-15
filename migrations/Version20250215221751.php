<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250215221751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE region_user (region_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5435C17E98260155 (region_id), INDEX IDX_5435C17EA76ED395 (user_id), PRIMARY KEY(region_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE region_user ADD CONSTRAINT FK_5435C17E98260155 FOREIGN KEY (region_id) REFERENCES region (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE region_user ADD CONSTRAINT FK_5435C17EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FCE83E5F');
        $this->addSql('DROP INDEX IDX_8D93D649FCE83E5F ON user');
        $this->addSql('ALTER TABLE user DROP regions_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE region_user DROP FOREIGN KEY FK_5435C17E98260155');
        $this->addSql('ALTER TABLE region_user DROP FOREIGN KEY FK_5435C17EA76ED395');
        $this->addSql('DROP TABLE region_user');
        $this->addSql('ALTER TABLE user ADD regions_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FCE83E5F FOREIGN KEY (regions_id) REFERENCES region (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D649FCE83E5F ON user (regions_id)');
    }
}
