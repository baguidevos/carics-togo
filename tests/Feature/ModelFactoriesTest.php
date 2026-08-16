<?php

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\ContactSubmission;
use App\Models\News;
use App\Models\NewsletterSubscriber;
use App\Models\Opportunity;
use App\Models\Partner;
use App\Models\Publication;
use App\Models\ResearchProject;
use App\Models\Resource;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\User;

test('all model factories create valid database records', function () {
    expect(User::factory()->create())->toBeInstanceOf(User::class);
    expect(TeamMember::factory()->founder()->create())->toBeInstanceOf(TeamMember::class);
    expect(Partner::factory()->create())->toBeInstanceOf(Partner::class);
    expect(Category::factory()->create())->toBeInstanceOf(Category::class);
    expect(ResearchProject::factory()->create())->toBeInstanceOf(ResearchProject::class);
    expect(BlogPost::factory()->create())->toBeInstanceOf(BlogPost::class);
    expect(Publication::factory()->create())->toBeInstanceOf(Publication::class);
    expect(Opportunity::factory()->create())->toBeInstanceOf(Opportunity::class);
    expect(News::factory()->create())->toBeInstanceOf(News::class);
    expect(Resource::factory()->create())->toBeInstanceOf(Resource::class);
    expect(ContactSubmission::factory()->create())->toBeInstanceOf(ContactSubmission::class);
    expect(NewsletterSubscriber::factory()->create())->toBeInstanceOf(NewsletterSubscriber::class);
    expect(SiteSetting::factory()->create())->toBeInstanceOf(SiteSetting::class);
});
