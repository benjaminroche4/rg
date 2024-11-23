<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114121446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_post ADD editor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01D6995AC4C FOREIGN KEY (editor_id) REFERENCES blog_editor (id)');
        $this->addSql('CREATE INDEX IDX_BA5AE01D6995AC4C ON blog_post (editor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01D6995AC4C');
        $this->addSql('DROP INDEX IDX_BA5AE01D6995AC4C ON blog_post');
        $this->addSql('ALTER TABLE blog_post DROP editor_id');
    }
}
