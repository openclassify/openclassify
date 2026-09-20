<?php

declare(strict_types=1);

namespace Modules\Page\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Page\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->records() as $record) {
            Page::query()->updateOrCreate(['slug' => $record['slug']], $record);
        }
    }

    private function records(): array
    {
        return [
            [
                'slug' => 'about',
                'title' => 'About us',
                'excerpt' => 'A marketplace built for people who want to buy and sell without friction.',
                'placement' => Page::PLACEMENT_FOOTER,
                'sort_order' => 1,
                'meta_description' => 'Learn how OpenClassify connects local buyers and sellers.',
                'body' => "OpenClassify is a classifieds marketplace for local communities. We connect people who want to sell things they no longer need with people looking for a good deal nearby.\n\nEvery listing is created by a real member of the community. We keep the platform simple: post an item in under a minute, talk directly to the buyer or seller, and close the deal on your own terms.\n\nOur team reviews reported content, keeps the categories tidy, and works to make the marketplace safe for everyone.",
            ],
            [
                'slug' => 'how-it-works',
                'title' => 'How it works',
                'excerpt' => 'Post, chat, and close the deal in three steps.',
                'placement' => Page::PLACEMENT_HELP,
                'sort_order' => 1,
                'meta_description' => 'Three steps to sell or buy on OpenClassify.',
                'body' => "Create your listing\nAdd photos, a clear title, an honest description, and a price. Choose the right category so buyers can find you.\n\nTalk to buyers\nBuyers message you directly or send a price offer. Reply from your inbox on any device.\n\nClose the deal\nAgree on a price, meet in a safe public place, and mark the listing as sold when you are done.",
            ],
            [
                'slug' => 'safety-tips',
                'title' => 'Safety tips',
                'excerpt' => 'Simple rules that keep every trade safe.',
                'placement' => Page::PLACEMENT_HELP,
                'sort_order' => 2,
                'meta_description' => 'Stay safe while buying and selling on OpenClassify.',
                'body' => "Meet in public\nChoose a busy, well-lit place for the handover. Bring a friend when the item is valuable.\n\nInspect before you pay\nCheck the item carefully and test anything electronic before money changes hands.\n\nNever send money in advance\nAvoid wire transfers, gift cards, and deposits to people you have not met.\n\nKeep the conversation on the platform\nMessages stay on record, which helps if something goes wrong.\n\nReport anything suspicious\nUse the report button on any listing or seller profile. Our team reviews every report.",
            ],
            [
                'slug' => 'terms',
                'title' => 'Terms of service',
                'excerpt' => 'The rules for using the marketplace.',
                'placement' => Page::PLACEMENT_LEGAL,
                'sort_order' => 1,
                'meta_description' => 'Terms of service for the OpenClassify marketplace.',
                'body' => "Using the marketplace\nBy creating an account you agree to post accurate listings and to treat other members with respect.\n\nProhibited items\nWeapons, counterfeit goods, illegal substances, live animals, and stolen property may not be listed.\n\nAccount responsibility\nYou are responsible for the activity on your account and for keeping your credentials private.\n\nContent ownership\nYou keep ownership of the photos and text you upload and grant us permission to display them on the marketplace.\n\nTermination\nWe may suspend accounts that break these terms or that put other members at risk.",
            ],
            [
                'slug' => 'privacy',
                'title' => 'Privacy policy',
                'excerpt' => 'What we collect and how we use it.',
                'placement' => Page::PLACEMENT_LEGAL,
                'sort_order' => 2,
                'meta_description' => 'How OpenClassify handles your personal data.',
                'body' => "What we collect\nWe store the account details you provide, the listings you publish, and the messages you exchange on the platform.\n\nHow we use it\nYour data is used to operate the marketplace, to show your listings to buyers, and to keep the platform safe.\n\nWhat we share\nWe never sell personal data. Contact details are only shown to members you choose to share them with.\n\nYour choices\nYou can edit your profile, delete your listings, or close your account at any time from your panel.",
            ],
            [
                'slug' => 'contact',
                'title' => 'Contact',
                'excerpt' => 'Reach the team behind the marketplace.',
                'placement' => Page::PLACEMENT_FOOTER,
                'sort_order' => 2,
                'meta_description' => 'Contact the OpenClassify support team.',
                'body' => "Support\nWrite to support@openclassify.test and we will reply within one business day.\n\nTrust and safety\nReport listings and profiles directly from the report button. Urgent cases reach our moderation team first.\n\nPartnerships\nFor business enquiries, write to partners@openclassify.test.",
            ],
        ];
    }
}
