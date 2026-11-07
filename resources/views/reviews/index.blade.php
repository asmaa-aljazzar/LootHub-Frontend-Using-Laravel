{{-- Included inside a product page; no separate layout is needed. --}}
@php
    $reviews = $reviews ?? [['id' => 1, 'rating' => 5, 'comment' => 'Great quality! This is a sample review.', 'user_id' => 1]];
    $reviewProductId = (int) ($productId ?? ($product['id'] ?? 0));
    $userId = $userId ?? null;
    $reviewUrl = url('/reviews') . '?product_id=' . $reviewProductId;
@endphp

<section class="user-review-section" aria-labelledby="user-reviews-heading" data-user-review-section
    data-reviews-url="{{ $reviewUrl }}" data-product-id="{{ $reviewProductId }}"
    data-user-id="{{ $userId !== null ? (int) $userId : '' }}">

    <div class="user-section-heading">
        <div>
            <p class="user-eyebrow">From the community</p>

            <h2 id="user-reviews-heading">
                Reviews
            </h2>

            <p data-user-review-status>
                See what other customers think about this product.
            </p>
        </div>
    </div>

    <!-- REVIEWS LIST -->
    <div class="user-review-list" data-user-review-list>

        @if (empty($reviews))

            <p class="user-status-note" data-user-review-empty>
                No reviews yet. Be the first to share your experience!
            </p>
        @else
            @foreach ($reviews as $review)
                @php
                    $reviewId = (int) ($review['id'] ?? 0);
                    $reviewRating = (int) ($review['rating'] ?? 0);
                    $reviewComment = (string) ($review['comment'] ?? '');
                    $reviewUserId = (int) ($review['user_id'] ?? 0);

                    $isOwner = $userId !== null && $reviewUserId === (int) $userId;
                @endphp

                <article class="user-info-card user-review-card">

                    <div class="user-review-content">

                        <strong>
                            {{ $reviewRating }}/5 ★
                        </strong>

                        <p dir="auto" style="white-space: pre-line;">
                            {{ $reviewComment }}
                        </p>

                    </div>

                    @if ($isOwner)
                        <!-- DELETE OWN REVIEW -->
                        <form action="{{ url('/reviews/delete') }}" method="POST">

                            @csrf

                            <input type="hidden" name="review_id" value="{{ $reviewId }}">

                            <input type="hidden" name="product_id" value="{{ $reviewProductId }}">

                            <button class="user-button-quiet" type="submit"
                                onclick="return confirm('Delete your review?')">
                                Delete Review
                            </button>

                        </form>
                    @endif

                </article>
            @endforeach

        @endif

    </div>

    <!-- Reviews are displayed to everyone, but writing is enabled only after a verified purchase. -->
    <p class="user-status-note" data-user-review-eligibility>Purchase this item to unlock your review.</p>
    <!-- WRITE REVIEW -->
    @if ($userId !== null)
        <form class="user-review-form" action="{{ url('/reviews') }}" method="POST" data-user-review-form
            data-user-async-form hidden>

            <h3>Share your experience</h3>

            @csrf

            <input type="hidden" name="product_id" value="{{ $reviewProductId }}">

            <!-- RATING -->
            <div class="user-field">

                <label for="user-review-rating">
                    Rating
                </label>

                <select class="user-select" id="user-review-rating" name="rating" required>

                    <option value="">
                        Choose a rating
                    </option>

                    <option value="5">
                        5 — Excellent
                    </option>

                    <option value="4">
                        4 — Great
                    </option>

                    <option value="3">
                        3 — Good
                    </option>

                    <option value="2">
                        2 — Fair
                    </option>

                    <option value="1">
                        1 — Poor
                    </option>

                </select>

            </div>

            <!-- COMMENT -->
            <div class="user-field">

                <label for="user-review-comment">
                    Your Review
                </label>

                <textarea class="user-textarea" id="user-review-comment" name="comment" maxlength="5000" required></textarea>

            </div>

            <p class="user-form-message" data-user-form-message role="status" aria-live="polite"></p>

            <div class="user-form-actions">

                <button class="user-button" type="submit" data-user-submit>
                    Post Review
                </button>

            </div>

        </form>
    @else
        <p class="user-status-note">

            <span aria-hidden="true">i</span>

            <span>
                <a href="{{ url('/login') }}">
                    Log in
                </a>
                to share a review.
            </span>

        </p>
    @endif

</section>
