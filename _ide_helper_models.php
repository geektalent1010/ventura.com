<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */

namespace App\Models{
    /**
     * App\Models\AdvancedRank
     *
     * @property int $id
     * @property int $user_id
     * @property int $rank_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Rank $rank
     * @property-read \App\Models\User $user
     *
     * @method static \Illuminate\Database\Eloquent\Builder|AdvancedRank newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|AdvancedRank newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|AdvancedRank query()
     * @method static \Illuminate\Database\Eloquent\Builder|AdvancedRank whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|AdvancedRank whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|AdvancedRank whereRankId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|AdvancedRank whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|AdvancedRank whereUserId($value)
     */
    class AdvancedRank extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Channel
     *
     * @property int $id
     * @property int $user_id
     * @property int $receive_user_id
     * @property string $channel_unique_name
     * @property string|null $last_read_message_sid
     * @property string|null $last_message_readed_at
     * @property int|null $is_connected
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\User $otherUser
     * @property-read \App\Models\User $user
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Channel newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Channel newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Channel query()
     * @method static \Illuminate\Database\Eloquent\Builder|Channel whereChannelUniqueName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Channel whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Channel whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Channel whereIsConnected($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Channel whereLastMessageReadedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Channel whereLastReadMessageSid($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Channel whereReceiveUserId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Channel whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Channel whereUserId($value)
     */
    class Channel extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\City
     *
     * @property int $id
     * @property string $name
     * @property int $active
     * @property int $state_id
     * @property-read \App\Models\State $state
     *
     * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|City query()
     * @method static \Illuminate\Database\Eloquent\Builder|City whereActive($value)
     * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|City whereStateId($value)
     */
    class City extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Country
     *
     * @property int $id
     * @property string $code
     * @property string $name
     * @property string $phonecode
     * @property int $active
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\State> $states
     * @property-read int|null $states_count
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Country query()
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereActive($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country wherePhonecode($value)
     */
    class Country extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Friend
     *
     * @property int $id
     * @property int $user_id
     * @property int $connected_user_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\User $connectedUser
     * @property-read \App\Models\User $user
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Friend newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Friend newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Friend query()
     * @method static \Illuminate\Database\Eloquent\Builder|Friend whereConnectedUserId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Friend whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Friend whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Friend whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Friend whereUserId($value)
     */
    class Friend extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Invite
     *
     * @property int $id
     * @property int $user_id
     * @property int $requester
     * @property int $member_id
     * @property int|null $is_active
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Member $inviteMember
     * @property-read \App\Models\User $requestUser
     * @property-read \App\Models\User $user
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Invite newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Invite newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Invite query()
     * @method static \Illuminate\Database\Eloquent\Builder|Invite whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Invite whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Invite whereIsActive($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Invite whereMemberId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Invite whereRequester($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Invite whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Invite whereUserId($value)
     */
    class Invite extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Member
     *
     * @property int $id
     * @property int $team_id
     * @property int $user_id
     * @property int|null $is_banned
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Team $team
     * @property-read \App\Models\User $user
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Member newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Member newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Member query()
     * @method static \Illuminate\Database\Eloquent\Builder|Member whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Member whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Member whereIsBanned($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Member whereTeamId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Member whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Member whereUserId($value)
     */
    class Member extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Notification
     *
     * @property int $id
     * @property int $user_id
     * @property int|null $last_read_request_id
     * @property int|null $last_read_news_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\User $user
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
     * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Notification whereLastReadNewsId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Notification whereLastReadRequestId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUserId($value)
     */
    class Notification extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Post
     *
     * @property int $id
     * @property string|null $title
     * @property string|null $description
     * @property string|null $subject
     * @property string|null $content
     * @property string|null $address
     * @property string|null $event_date
     * @property string|null $main_featured_image_url
     * @property string|null $small_featured_image_url1
     * @property string|null $small_featured_image_url2
     * @property string|null $small_featured_image_url3
     * @property string|null $small_featured_image_url4
     * @property string|null $followers
     * @property int|null $type
     * @property int|null $is_active
     * @property int $created_by
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\User $user
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Post query()
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereAddress($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedBy($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereEventDate($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereFollowers($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsActive($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereMainFeaturedImageUrl($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereSmallFeaturedImageUrl1($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereSmallFeaturedImageUrl2($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereSmallFeaturedImageUrl3($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereSmallFeaturedImageUrl4($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereSubject($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
     */
    class Post extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Profile
     *
     * @property int $id
     * @property int $user_id
     * @property string $first_name
     * @property string $last_name
     * @property string $birthday
     * @property string|null $gender
     * @property string|null $phone
     * @property string|null $company_name
     * @property string|null $site_url
     * @property string|null $vat_number
     * @property string|null $main_avatar_url
     * @property string|null $other_avatar_url1
     * @property string|null $other_avatar_url2
     * @property string|null $other_avatar_url3
     * @property string|null $other_avatar_url4
     * @property string|null $other_avatar_url5
     * @property string|null $other_avatar_url6
     * @property string|null $other_avatar_url7
     * @property string|null $other_avatar_url8
     * @property string|null $banner_img_url
     * @property string|null $logo_url
     * @property string|null $city
     * @property string|null $street
     * @property string|null $house_number
     * @property string|null $state
     * @property string|null $country
     * @property string|null $postal_code
     * @property string|null $job_title
     * @property string|null $main_interests
     * @property string|null $other_interests
     * @property string|null $story_content
     * @property string|null $followers
     * @property string|null $trash_buddies
     * @property string|null $interest_based
     * @property string|null $display_options
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property string|null $studio_header1
     * @property string|null $studio_content1
     * @property string|null $studio_footer1
     * @property string|null $studio_image1
     * @property string|null $studio_header2
     * @property string|null $studio_content2
     * @property string|null $studio_footer2
     * @property string|null $studio_image2
     * @property string|null $studio_header3
     * @property string|null $studio_content3
     * @property string|null $studio_footer3
     * @property string|null $studio_image3
     * @property string|null $studio_header4
     * @property string|null $studio_content4
     * @property string|null $studio_footer4
     * @property string|null $studio_image4
     * @property int $darken_mode_1
     * @property int $darken_mode_2
     * @property int $darken_mode_3
     * @property int $darken_mode_4
     * @property-read \App\Models\User $user
     *
     * @method static \Database\Factories\ProfileFactory factory($count = null, $state = [])
     * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBannerImgUrl($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBirthday($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCity($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCompanyName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCountry($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDarkenMode1($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDarkenMode2($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDarkenMode3($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDarkenMode4($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDisplayOptions($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFirstName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFollowers($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereGender($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereHouseNumber($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereInterestBased($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereJobTitle($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLastName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLogoUrl($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereMainAvatarUrl($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereMainInterests($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOtherAvatarUrl1($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOtherAvatarUrl2($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOtherAvatarUrl3($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOtherAvatarUrl4($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOtherAvatarUrl5($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOtherAvatarUrl6($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOtherAvatarUrl7($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOtherAvatarUrl8($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOtherInterests($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePhone($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostalCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereSiteUrl($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereState($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStoryContent($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStreet($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioContent1($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioContent2($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioContent3($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioContent4($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioFooter1($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioFooter2($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioFooter3($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioFooter4($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioHeader1($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioHeader2($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioHeader3($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioHeader4($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioImage1($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioImage2($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioImage3($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudioImage4($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereTrashBuddies($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereVatNumber($value)
     */
    class Profile extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Rank
     *
     * @property int $id
     * @property string|null $name
     * @property int|null $level
     * @property int|null $profit
     * @property int|null $customers
     * @property int|null $partners
     * @property int|null $partner_group
     * @property int|null $channel1
     * @property int|null $channel2
     * @property int|null $is_active
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Rank newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Rank newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Rank query()
     * @method static \Illuminate\Database\Eloquent\Builder|Rank whereChannel1($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Rank whereChannel2($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Rank whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Rank whereCustomers($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Rank whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Rank whereIsActive($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Rank whereLevel($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Rank whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Rank wherePartnerGroup($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Rank wherePartners($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Rank whereProfit($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Rank whereUpdatedAt($value)
     */
    class Rank extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\RankAchievementHistory
     *
     * @property int $id
     * @property int $user_id
     * @property int $rank_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Rank $rank
     * @property-read \App\Models\User $user
     *
     * @method static \Illuminate\Database\Eloquent\Builder|RankAchievementHistory newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|RankAchievementHistory newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|RankAchievementHistory query()
     * @method static \Illuminate\Database\Eloquent\Builder|RankAchievementHistory whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|RankAchievementHistory whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|RankAchievementHistory whereRankId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|RankAchievementHistory whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|RankAchievementHistory whereUserId($value)
     */
    class RankAchievementHistory extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\RankUser
     *
     * @property int $id
     * @property int $user_id
     * @property int $rank_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Rank $rank
     * @property-read \App\Models\User $user
     *
     * @method static \Illuminate\Database\Eloquent\Builder|RankUser newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|RankUser newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|RankUser query()
     * @method static \Illuminate\Database\Eloquent\Builder|RankUser whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|RankUser whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|RankUser whereRankId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|RankUser whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|RankUser whereUserId($value)
     */
    class RankUser extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Requests
     *
     * @property int $id
     * @property int $user_id
     * @property int $requester
     * @property string $context
     * @property int|null $is_active
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\User $requestUser
     * @property-read \App\Models\User $user
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Requests newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Requests newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Requests query()
     * @method static \Illuminate\Database\Eloquent\Builder|Requests whereContext($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Requests whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Requests whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Requests whereIsActive($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Requests whereRequester($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Requests whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Requests whereUserId($value)
     */
    class Requests extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\State
     *
     * @property int $id
     * @property string $name
     * @property int $active
     * @property int $country_id
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\City> $cities
     * @property-read int|null $cities_count
     * @property-read \App\Models\Country $country
     *
     * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|State query()
     * @method static \Illuminate\Database\Eloquent\Builder|State whereActive($value)
     * @method static \Illuminate\Database\Eloquent\Builder|State whereCountryId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|State whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|State whereName($value)
     */
    class State extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Team
     *
     * @property int $id
     * @property int $user_id
     * @property string $channel_unique_name
     * @property string|null $team_logo
     * @property string $name
     * @property string $description
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Member> $members
     * @property-read int|null $members_count
     * @property-read \App\Models\User $user
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Team query()
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereChannelUniqueName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereTeamLogo($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereUserId($value)
     */
    class Team extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\User
     *
     * @property int $id
     * @property int|null $customer_id
     * @property int $sponsor_id
     * @property string $username
     * @property string $email
     * @property \Illuminate\Support\Carbon|null $email_verified_at
     * @property string $password
     * @property int|null $is_admin
     * @property int|null $user_type
     * @property int|null $status
     * @property int|null $channel
     * @property string|null $remember_token
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property string|null $last_seen
     * @property-read \App\Models\AdvancedRank|null $advancedRank
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Channel> $channels
     * @property-read int|null $channels_count
     * @property-read \App\Models\Notification|null $notification
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
     * @property-read int|null $notifications_count
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
     * @property-read int|null $posts_count
     * @property-read \App\Models\Profile|null $profile
     * @property-read \App\Models\RankUser|null $rank
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RankAchievementHistory> $rankHistory
     * @property-read int|null $rank_history_count
     * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $referrers
     * @property-read int|null $referrers_count
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Member> $teamMembers
     * @property-read int|null $team_members_count
     * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $teams
     * @property-read int|null $teams_count
     *
     * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
     * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User query()
     * @method static \Illuminate\Database\Eloquent\Builder|User whereChannel($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCustomerId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereLastSeen($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereSponsorId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUserType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
     */
    class User extends \Eloquent
    {
    }
}
